<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Translator;
use Respect\Validation\Mixins\StaticValidator;
use Respect\Validation\Rules\Core\Binder;
use Respect\Validation\Rules\Core\Reducer;
use Throwable;

use function is_array;
use function is_callable;
use function is_string;

/**
 * @mixin StaticValidator
 */
final class Validator implements Rule
{
    /** @var array<Rule> */
    private array $rules = [];

    /** @var array<string, mixed> */
    private array $templates = [];

    private ?string $name = null;

    private ?string $template = null;

    public function __construct(
        private readonly Factory $factory,
        private readonly Formatter $formatter,
        private readonly Translator $translator,
    ) {
    }

    public static function create(Rule ...$rules): self
    {
        $validator = new self(
            ValidatorDefaults::getFactory(),
            ValidatorDefaults::getFormatter(),
            ValidatorDefaults::getTranslator()
        );
        $validator->rules = $rules;

        return $validator;
    }

    public function evaluate(mixed $input): Result
    {
        return (new Binder($this, new Reducer(...$this->rules)))->evaluate($input);
    }

    public function isValid(mixed $input): bool
    {
        return $this->evaluate($input)->isValid;
    }

    /** @param array<string, mixed>|callable(ValidationException): Throwable|string|Throwable|null $template */
    public function assert(mixed $input, array|string|Throwable|callable|null $template = null): void
    {
        $message = $this->failures($input, is_array($template) || is_string($template) ? $template : null);
        if ($message === null) {
            return;
        }

        if ($template instanceof Throwable) {
            throw $template;
        }

        $exception = new ValidationException($message->message, $message->fullMessage, $message->messages);

        if (!is_callable($template)) {
            throw $exception;
        }

        throw $template($exception);
    }

    /** @param array<string, mixed>|string|null $template */
    public function failures(mixed $input, array|string|null $template = null): ?Failures
    {
        $result = $this->evaluate($input);
        if ($result->isValid) {
            return null;
        }

        $templates = $this->templates;
        if (is_array($template)) {
            $templates = $template;
        } elseif (is_string($template)) {
            $templates = ['__root__' => $template];
        } elseif ($this->getTemplate() != null) {
            $templates = ['__root__' => $this->getTemplate()];
        }

        return new Failures(
            $result,
            $this->formatter->main($result, $templates, $this->translator),
            $this->formatter->full($result, $templates, $this->translator),
            $this->formatter->array($result, $templates, $this->translator)
        );
    }

    /** @param array<string, mixed> $templates */
    public function setTemplates(array $templates): self
    {
        $this->templates = $templates;

        return $this;
    }

    /** @return array<Rule> */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @deprecated Use {@see isValid()} instead.
     */
    public function validate(mixed $input): bool
    {
        return $this->evaluate($input)->isValid;
    }

    /**
     * @deprecated Use {@see assert()} instead.
     */
    public function check(mixed $input): void
    {
        $this->assert($input);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @param mixed[] $arguments
     */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    /**
     * @param mixed[] $arguments
     */
    public function __call(string $ruleName, array $arguments): self
    {
        $this->rules[] = $this->factory->rule($ruleName, $arguments);

        return $this;
    }
}
