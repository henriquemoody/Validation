<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use ReflectionClass;
use Respect\Stringifier\Stringifier;
use Respect\Validation\Message\Placeholder\Listed;
use Respect\Validation\Message\Placeholder\Quoted;
use Respect\Validation\Result;
use Respect\Validation\Rule;

use function is_array;
use function is_bool;
use function is_scalar;
use function is_string;
use function preg_replace_callback;
use function print_r;

final class StandardRenderer implements Renderer
{
    /** @var array<string, array<Template>> */
    private array $templates = [];

    public function __construct(
        private readonly Stringifier $stringifier = new StandardStringifier(),
    ) {
    }

    public function render(Result $result, Translator $translator, ?string $template = null): string
    {
        $parameters = $result->parameters;
        $parameters['path'] = $result->path !== null ? Quoted::fromPath($result->path) : null;
        $parameters['input'] = $result->input;

        $builtName = $result->name ?? $parameters['path'] ?? $this->placeholder('input', $result->input, $translator);
        $parameters['name'] ??= $builtName;

        $rendered = (string) preg_replace_callback(
            '/{{(\w+)(\|([^}]+))?}}/',
            function (array $matches) use ($parameters, $translator) {
                if (!isset($parameters[$matches[1]])) {
                    return $matches[0];
                }

                return $this->placeholder($matches[1], $parameters[$matches[1]], $translator, $matches[3] ?? null);
            },
            $translator->translate($template ?? $this->getTemplateMessage($result))
        );

        if (!$result->hasCustomTemplate() && $result->adjacent !== null) {
            $rendered .= ' ' . $this->render($result->adjacent, $translator);
        }

        return $rendered;
    }

    /** @return array<Template> */
    private function extractTemplates(Rule $rule): array
    {
        if (!isset($this->templates[$rule::class])) {
            $reflection = new ReflectionClass($rule);
            foreach ($reflection->getAttributes(Template::class) as $attribute) {
                $this->templates[$rule::class][] = $attribute->newInstance();
            }
        }

        return $this->templates[$rule::class] ?? [];
    }

    private function placeholder(string $name, mixed $value, Translator $translator, ?string $modifier = null): string
    {
        if ($modifier === 'quote' && is_string($value)) {
            return $this->placeholder($name, new Quoted($value), $translator);
        }

        if ($modifier === 'listOr' && is_array($value)) {
            return $this->placeholder($name, new Listed($value, $translator->translate('or')), $translator);
        }

        if ($modifier === 'listAnd' && is_array($value)) {
            return $this->placeholder($name, new Listed($value, $translator->translate('and')), $translator);
        }

        if ($modifier === 'raw' && is_scalar($value)) {
            return is_bool($value) ? (string) (int) $value : (string) $value;
        }

        if ($modifier === 'trans' && is_string($value)) {
            return $translator->translate($value);
        }

        if ($name === 'name' && is_string($value)) {
            return $value;
        }

        return $this->stringifier->stringify($value, 0) ?? print_r($value, true);
    }

    private function getTemplateMessage(Result $result): string
    {
        if ($result->hasCustomTemplate()) {
            return $result->template;
        }

        foreach ($this->extractTemplates($result->rule) as $template) {
            if ($template->id !== $result->template) {
                continue;
            }

            if ($result->hasInvertedMode) {
                return $template->inverted;
            }

            return $template->default;
        }

        return $result->template;
    }
}
