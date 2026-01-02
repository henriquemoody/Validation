<?php

declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Swaps the argument order in v::templated() calls
 *
 * Before: v::templated(v::stringType(), "My template")
 * After: v::templated("My template", v::stringType())
 */
final class SwapTemplatedArgumentsRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Swap argument order in v::templated() calls to put template first',
            [
                new CodeSample(
                    'v::templated(v::stringType(), "My template")',
                    'v::templated("My template", v::stringType())'
                ),
                new CodeSample(
                    'v::templated(v::stringType()->intType(), "Custom message")',
                    'v::templated("Custom message", v::stringType()->intType())'
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [StaticCall::class];
    }

    /**
     * @param StaticCall $node
     */
    public function refactor(Node $node): ?Node
    {
        // Verify it's calling v::templated()
        if (!$node->class instanceof Name) {
            return null;
        }

        if ($node->class->toString() !== 'v') {
            return null;
        }

        // Only process v::templated() static calls
        if (!$this->isName($node->name, 'templated')) {
            return null;
        }

        // Must have 2 or 3 arguments
        $argCount = count($node->args);
        if ($argCount !== 2 && $argCount !== 3) {
            return null;
        }

        $firstArg = $node->args[0];
        $secondArg = $node->args[1];

        if ($argCount === 2) {
            // Simple case: swap the two arguments
            // v::templated(rule, template) -> v::templated(template, rule)
            $node->args = [$secondArg, $firstArg];
        } else {
            // 3 arguments: v::templated(rule, template, params) -> v::templated(template, rule, params)
            $thirdArg = $node->args[2];
            $node->args = [$secondArg, $firstArg, $thirdArg];
        }

        return $node;
    }
}

