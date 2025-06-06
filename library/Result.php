<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Rules\Core\Nameable;

use function array_filter;
use function array_map;
use function count;
use function end;
use function explode;
use function lcfirst;
use function preg_match;
use function strrchr;
use function substr;
use function ucfirst;

final class Result
{
    /** @var array<Result> */
    public readonly array $children;

    public readonly string $id;

    /** @param array<string, mixed> $parameters */
    public function __construct(
        public readonly bool $hasPassed,
        public readonly mixed $input,
        public readonly Rule $rule,
        public readonly array $parameters = [],
        public readonly string $template = Rule::TEMPLATE_STANDARD,
        public readonly bool $hasInvertedMode = false,
        public readonly ?string $name = null,
        ?string $id = null,
        public readonly ?Result $adjacent = null,
        public readonly string|int|null $path = null,
        Result ...$children,
    ) {
        $this->id = $id ?? lcfirst(substr((string) strrchr($rule::class, '\\'), 1));
        $this->children = $children;
    }

    /** @param array<string, mixed> $parameters */
    public static function failed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD
    ): self {
        return new self(false, $input, $rule, $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function passed(
        mixed $input,
        Rule $rule,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD
    ): self {
        return new self(true, $input, $rule, $parameters, $template);
    }

    /** @param array<string, mixed> $parameters */
    public static function fromAdjacent(
        mixed $input,
        string $prefix,
        Rule $rule,
        Result $adjacent,
        array $parameters = [],
        string $template = Rule::TEMPLATE_STANDARD
    ): Result {
        if ($adjacent->allowsAdjacent()) {
            return (new Result($adjacent->hasPassed, $input, $rule, $parameters, $template, id: $adjacent->id))
                ->withPrefix($prefix)
                ->withAdjacent($adjacent->withInput($input));
        }

        $childrenAsAdjacent = array_map(
            static fn(Result $child) => self::fromAdjacent($input, $prefix, $rule, $child, $parameters, $template),
            $adjacent->children
        );

        return $adjacent->withInput($input)->withChildren(...$childrenAsAdjacent);
    }

    public function withTemplate(string $template): self
    {
        return $this->clone(template: $template);
    }

    /** @param array<string, mixed> $parameters */
    public function withExtraParameters(array $parameters): self
    {
        return $this->clone(parameters: $parameters + $this->parameters);
    }

    public function withId(string $id): self
    {
        return $this->clone(id: $id);
    }

    public function withIdFrom(Rule $rule): self
    {
        return $this->clone(id: lcfirst(substr((string) strrchr($rule::class, '\\'), 1)));
    }

    public function withPath(string|int $path): self
    {
        return $this->clone(
            adjacent: $this->adjacent?->withPath($path),
            path: $this->path === null ? $path : $path . '.' . $this->path,
        );
    }

    public function withDeepestPath(): self
    {
        $path = $this->getDeepestPath();
        if ($path === null || $path === (string) $this->path) {
            return $this;
        }

        return $this->clone(
            adjacent: $this->adjacent?->withPath($path),
            path: $path,
        );
    }

    public function getDeepestPath(): ?string
    {
        if ($this->path === null) {
            return null;
        }

        $paths = explode('.', (string) $this->path);
        if (count($paths) === 1) {
            return (string) $this->path;
        }

        return end($paths);
    }

    public function withPrefix(string $prefix): self
    {
        if ($this->id === $this->name || $this->path !== null) {
            return $this;
        }

        return $this->clone(id: $prefix . ucfirst($this->id));
    }

    public function withChildren(Result ...$children): self
    {
        return $this->clone(children: $children);
    }

    public function withName(string $name): self
    {
        return $this->clone(
            name: $this->name ?? $name,
            adjacent: $this->adjacent?->withName($name),
            children: array_map(
                static fn (Result $child) => $child->path === null ? $child->withName($child->name ?? $name) : $child,
                $this->children
            ),
        );
    }

    public function withNameFrom(Rule $rule): self
    {
        if ($rule instanceof Nameable && $rule->getName() !== null) {
            return $this->withName($rule->getName());
        }

        return $this;
    }

    public function withInput(mixed $input): self
    {
        $currentInput = $this->input;

        return $this->clone(
            input: $input,
            children: array_map(
                static fn (Result $child) => $child->input === $currentInput ? $child->withInput($input) : $child,
                $this->children
            ),
        );
    }

    public function withAdjacent(Result $adjacent): self
    {
        return $this->clone(adjacent: $adjacent);
    }

    public function withToggledValidation(): self
    {
        return $this->clone(
            hasPassed: !$this->hasPassed,
            adjacent: $this->adjacent?->withToggledValidation(),
            children: array_map(static fn (Result $child) => $child->withToggledValidation(), $this->children),
        );
    }

    public function withToggledModeAndValidation(): self
    {
        return $this->clone(
            hasPassed: !$this->hasPassed,
            mode: !$this->hasInvertedMode,
            adjacent: $this->adjacent?->withToggledModeAndValidation(),
            children: array_map(static fn (Result $child) => $child->withToggledModeAndValidation(), $this->children),
        );
    }

    public function hasCustomTemplate(): bool
    {
        return preg_match('/__[0-9a-z_]+_/', $this->template) === 0;
    }

    public function allowsAdjacent(): bool
    {
        if ($this->children === [] && !$this->hasCustomTemplate()) {
            return true;
        }

        $childrenThatAllowAdjacent = array_filter(
            $this->children,
            static fn (Result $child) => $child->allowsAdjacent()
        );

        return count($childrenThatAllowAdjacent) === 1;
    }

    /**
     * @param array<string, mixed> $parameters
     * @param array<Result>|null $children
     */
    private function clone(
        ?bool $hasPassed = null,
        mixed $input = null,
        ?array $parameters = null,
        ?string $template = null,
        ?bool $mode = null,
        ?string $name = null,
        ?string $id = null,
        ?Result $adjacent = null,
        string|int|null $path = null,
        ?array $children = null
    ): self {
        return new self(
            $hasPassed ?? $this->hasPassed,
            $input ?? $this->input,
            $this->rule,
            $parameters ?? $this->parameters,
            $template ?? $this->template,
            $mode ?? $this->hasInvertedMode,
            $name ?? $this->name,
            $id ?? $this->id,
            $adjacent ?? $this->adjacent,
            $path ?? $this->path,
            ...($children ?? $this->children)
        );
    }
}
