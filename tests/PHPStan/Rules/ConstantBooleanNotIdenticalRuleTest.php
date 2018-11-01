<?php

namespace Sourceability\CodingStandard\Tests\PHPStan\Rules;

use PHPStan\Rules\BooleansInConditions\BooleanRuleHelper;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Testing\RuleTestCase;
use Sourceability\CodingStandard\PHPStan\Rules\ConstantBooleanNotIdenticalRule;
use Sourceability\CodingStandard\PHPStan\Rules\ConstantBooleanRuleHelper;

class ConstantBooleanNotIdenticalRuleTest extends RuleTestCase
{
    public function testRule(): void
    {
        $this->analyse([__DIR__.'/data/conditions.php'], [
            [
                'Replace true !== $boolean with !$boolean',
                38,
            ],
            [
                'Replace $boolean !== true with !$boolean',
                43,
            ],
            [
                'Replace false !== $boolean with $boolean',
                48,
            ],
            [
                'Replace $boolean !== false with $boolean',
                53,
            ],
        ]);
    }

    protected function getRule(): Rule
    {
        $ruleLevelHelper = new RuleLevelHelper(
            $this->createBroker(),
            true,
            false,
            true
        );

        return new ConstantBooleanNotIdenticalRule(
            new ConstantBooleanRuleHelper($ruleLevelHelper),
            new BooleanRuleHelper($ruleLevelHelper)
        );
    }
}
