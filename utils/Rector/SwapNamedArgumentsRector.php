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
 * Swaps the argument order in v::named() calls
 *
 * Before: v::named(v::stringType(), "Name")
 * After: v::named("Name", v::stringType())
 */
final class SwapNamedArgumentsRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Swap argument order in v::named() calls to put name first',
            [
                new CodeSample(
                    'v::named(v::stringType(), "Name")',
                    'v::named("Name", v::stringType())'
                ),
                new CodeSample(
                    'v::named(v::stringType()->intType(), "Field Name")',
                    'v::named("Field Name", v::stringType()->intType())'
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
        // Verify it's calling v::named()
        if (!$node->class instanceof Name) {
            return null;
        }

        if ($node->class->toString() !== 'v') {
            return null;
        }

        // Only process v::named() static calls
        if (!$this->isName($node->name, 'named')) {
            return null;
        }

        // Must have exactly 2 arguments
        if (count($node->args) !== 2) {
            return null;
        }

        $firstArg = $node->args[0];
        $secondArg = $node->args[1];

        // Swap the arguments
        $node->args = [$secondArg, $firstArg];

        return $node;
    }
}

