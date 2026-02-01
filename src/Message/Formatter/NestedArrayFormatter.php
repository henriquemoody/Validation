<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Message\Formatter;

use Respect\Validation\Message\ArrayFormatter;
use Respect\Validation\Message\Renderer;
use Respect\Validation\Result;

use function array_reduce;
use function array_values;
use function count;
use function current;
use function is_array;
use function is_numeric;

final readonly class NestedArrayFormatter implements ArrayFormatter
{
    /**
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    public function format(Result $result, Renderer $renderer, array $templates): array
    {
        if ($result->children === []) {
            return [$this->getKey($result) => $renderer->render($result, $templates)];
        }

        [$children, $hasString] = $this->prepareChildren($result->children);

        $messages = array_reduce(
            $children,
            fn(array $messages, array $item) => $this->appendMessage(
                $messages,
                $item['key'],
                $item['child'],
                $renderer,
                $templates,
                $hasString,
                $result,
                isParentVisible: count($children) > 1,
            ),
            [],
        );

        if (count($messages) > 1) {
            return ['__root__' => $renderer->render($result, $templates)] + $messages;
        }

        return $messages;
    }

    /**
     * @param array<Result> $children
     *
     * @return array{0: array<array{key: string|int, child: Result}>, 1: bool}
     */
    private function prepareChildren(array $children): array
    {
        $mapped = [];
        $hasString = false;

        foreach ($children as $child) {
            $key = $this->getKey($child);
            if (!is_numeric($key)) {
                $hasString = true;
            }

            $mapped[] = ['key' => $key, 'child' => $child];
        }

        return [$mapped, $hasString];
    }

    /**
     * @param array<string|int, mixed> $messages
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    private function appendMessage(
        array $messages,
        string|int $key,
        Result $child,
        Renderer $renderer,
        array $templates,
        bool $hasString,
        Result $parent,
        bool $isParentVisible,
    ): array {
        $key = $this->normalizeKey($key, $hasString, $child);

        $appended = $this->renderChild($child, $renderer, $templates, $parent, $isParentVisible);

        if (is_array($appended) && count($appended) > 1 && !isset($appended['__root__'])) {
            $appended = ['__root__' => $renderer->render($child, $templates)] + $appended;
        }

        if (!$hasString) {
            $messages[] = $appended;

            return $messages;
        }

        if (!isset($messages[$key])) {
            $messages[$key] = $appended;

            return $messages;
        }

        if ($child->path !== null) {
            return $this->handlePathCollision($messages, $key, $appended);
        }

        return $this->handleIdCollision($messages, $appended, $parent, $renderer, $templates);
    }

    private function normalizeKey(string|int $key, bool $hasString, Result $child): string|int
    {
        if ($hasString && is_numeric($key)) {
            return $child->id->value;
        }

        return $key;
    }

    /**
     * @param array<string|int, mixed> $messages
     * @param array<int|string, mixed>|string $appended
     *
     * @return array<string|int, mixed>
     */
    private function handlePathCollision(array $messages, string|int $key, array|string $appended): array
    {
        if (is_array($messages[$key])) {
            if (isset($messages[$key]['__root__'])) {
                $messages[$key] = [$messages[$key]];
            }

            $messages[$key][] = $appended;
        } else {
            $messages[$key] = [$messages[$key], $appended];
        }

        return $messages;
    }

    /**
     * @param array<string|int, mixed> $messages
     * @param array<int|string, mixed>|string $appended
     * @param array<string|int, mixed> $templates
     *
     * @return array<string|int, mixed>
     */
    private function handleIdCollision(
        array $messages,
        array|string $appended,
        Result $parent,
        Renderer $renderer,
        array $templates,
    ): array {
        $parentMessage = $messages['__root__'] ?? $renderer->render($parent, $templates);
        $list = array_values($messages);
        $list[] = $appended;

        return ['__root__' => $parentMessage] + $list;
    }

    /**
     * @param array<string|int, array<string>> $templates
     *
     * @return array<string>|string
     */
    private function renderChild(
        Result $child,
        Renderer $renderer,
        array $templates,
        Result $parent,
        bool $isParentVisible,
    ): array|string {
        $formatted = $this->format(
            $isParentVisible && $child->name === $parent->name ? $child->withoutName() : $child,
            $renderer,
            $templates,
        );

        if (count($formatted) === 1) {
            return current($formatted);
        }

        return $formatted;
    }

    private function getKey(Result $result): string|int
    {
        return $result->path->value ?? $result->id->value;
    }
}
