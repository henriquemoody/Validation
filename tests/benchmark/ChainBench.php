<?php

namespace Respect\Validation\Benchmark;

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator;

class ChainBench
{
    public function benchChain()
    {
        try {
            Validator::positive()->between(1, 10)->intType()->assert(-0.6);
        } catch (ValidationException $e) {
            $e->getMessage();
        }
    }
}
