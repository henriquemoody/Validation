<?php

declare(strict_types=1);

namespace Utils\Rector;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * Transforms ->setTemplate() calls to v::templated() wrapper
 *
 * Before: v::stringType()->setTemplate("Something")
 * After: v::templated(v::stringType(), "Something")
 */
final class SetTemplateToTemplatedRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Replace ->setTemplate() method calls with v::templated() wrapper',
            [
                new CodeSample(
                    'v::stringType()->setTemplate("Something")',
                    'v::templated(v::stringType(), "Something")'
                ),
                new CodeSample(
                    'v::stringType()->intType()->setTemplate("Custom message")',
                    'v::templated(v::stringType()->intType(), "Custom message")'
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        // Only process setTemplate() method calls
        if (!$this->isName($node->name, 'setTemplate')) {
            return null;
        }

        // Get the template argument
        if (!isset($node->args[0]) || !$node->args[0] instanceof Arg) {
            return null;
        }

        $templateArg = $node->args[0];

        // Get the validator expression (everything before ->setTemplate())
        $validatorExpr = $node->var;

        // Create v::templated() call
        // v::templated($validatorExpr, $templateArg)
        $templatedCall = new StaticCall(
            new Name('v'),
            new Identifier('templated'),
            [
                new Arg($validatorExpr),
                $templateArg,
            ]
        );

        return $templatedCall;
    }
}

