<?php

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\InvalidRuleConstructorException;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Wrapper;

use function is_scalar;
use function mb_strlen;
use function mb_substr;
use function str_repeat;

final class Mask extends Wrapper
{
    /** @param "left"|"right"|"center"|"edges" $direction */
    public function __construct(
        Rule $rule,
        private readonly string $char = '*',
        private readonly string $direction = 'left',
        private readonly int $visible = 0,
    ) {
        $availableDirections = ["left", "right", "center", "edges"];
        if (!in_array($this->direction, $availableDirections, true)) {
            throw new InvalidRuleConstructorException(
                '"%s" is not a valid direction (Available: %s)',
                $this->direction,
                $availableDirections,
            );
        }
        parent::__construct($rule);
    }

    public function evaluate(mixed $input): Result
    {
        $result = $this->rule->evaluate($input);
        if (!is_scalar($result->input)) {
            return $result;
        }

        $string = (string) $result->input;
        $length = mb_strlen($string);
        if ($this->visible >= $length) {
            return $result;
        }

        $maskedLength = $length - $this->visible;
        $mask = str_repeat($this->char, $maskedLength);
        if ($this->visible === 0) {
            return $result->withInput($mask);
        }

        $masked = match ($this->direction) {
            'left' => $mask . mb_substr($string, -$this->visible),
            'right' => mb_substr($string, 0, $this->visible) . $mask,
            'center' => mb_substr($string, 0, (int) ($this->visible / 2)) .
                $mask .
                mb_substr($string, (int) ($this->visible / 2) + ($this->visible % 2)),
            'edges' => mb_substr($string, 0, 1) .
                $mask .
                mb_substr($string, -1),
            default => $string,
        };

        return $result->withInput($masked);
    }
}
