<?php

namespace Respect\Validation\Benchmark;


use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;

class SymfonyBench
{
    public function benchSymfony()
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate(-0.6, [
            new Positive(),
            new GreaterThanOrEqual(1),
            new LessThanOrEqual(10),
            new Type('int'),
        ]);

        $violations->__toString();
    }
}
