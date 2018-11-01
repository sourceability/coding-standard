<?php

namespace Sourceability\CodingStandard\PHPStan\Rules;

use PhpParser\Node\Expr;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Type\Constant\ConstantBooleanType;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;

class ConstantBooleanRuleHelper
{
    /**
     * @var RuleLevelHelper
     */
    private $ruleLevelHelper;

    public function __construct(RuleLevelHelper $ruleLevelHelper)
    {
        $this->ruleLevelHelper = $ruleLevelHelper;
    }

    public function getNonMixedConstantBooleanType(Scope $scope, Expr $expr): ?ConstantBooleanType
    {
        $type = $scope->getType($expr);
        if ($type instanceof MixedType) {
            return null;
        }

        $typeToCheck = $this->ruleLevelHelper->findTypeToCheck(
            $scope,
            $expr,
            '',
            static function (Type $type): bool {
                return $type instanceof ConstantBooleanType;
            }
        );

        $foundType = $typeToCheck->getType();
        if (!$foundType instanceof ConstantBooleanType) {
            return null;
        }

        return $foundType;
    }
}
