<?php

namespace Sourceability\CodingStandard\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;
use PHPStan\Type\VerbosityLevel;
use function count;
use function sprintf;

class InstanceOfVsNotNullRule implements Rule
{
    /**
     * @var RuleLevelHelper
     */
    private $ruleLevelHelper;

    public function __construct(RuleLevelHelper $ruleLevelHelper)
    {
        $this->ruleLevelHelper = $ruleLevelHelper;
    }

    public function getNodeType(): string
    {
        return Instanceof_::class;
    }

    /**
     * @return string[] errors
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof Instanceof_) {
            return [];
        }

        $typeToCheck = $this->ruleLevelHelper->findTypeToCheck(
            $scope,
            $node->expr,
            '',
            static function (Type $type): bool {
                return $type instanceof UnionType;
            }
        );

        $unionType = $typeToCheck->getType();
        if (!$unionType instanceof UnionType) {
            return [];
        }

        $types = $unionType->getTypes();

        if (count($types) > 2
            || !$node->class instanceof Name
        ) {
            return [];
        }

        $objectType = null;
        $nullType = null;
        foreach ($types as $type) {
            if ($type instanceof ObjectType) {
                $objectType = $type;

                continue;
            }

            if ($type instanceof NullType) {
                $nullType = $type;

                continue;
            }
        }

        if (null === $objectType
            || null === $nullType
        ) {
            return [];
        }

        if ($objectType->getClassName() === (string) $node->class) {
            $foundTypeDescription = $unionType->describe(VerbosityLevel::typeOnly());

            return [
                sprintf(
                    'Replace "expr<%s> instanceof %s" with "null !== expr<%s>"',
                    $foundTypeDescription,
                    (string) $node->class,
                    $foundTypeDescription
                ),
            ];
        }

        return [];
    }
}
