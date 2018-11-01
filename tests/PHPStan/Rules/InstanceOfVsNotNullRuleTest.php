<?php

namespace Sourceability\CodingStandard\Tests\PHPStan\Rules;

use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Testing\RuleTestCase;
use Sourceability\CodingStandard\PHPStan\Rules\InstanceOfVsNotNullRule;

class InstanceOfVsNotNullRuleTest extends RuleTestCase
{
    public function testRule(): void
    {
        $this->analyse([__DIR__.'/data/instanceof-vs-not-null.php'], [
            [
                'Replace "expr<Sourceability\CodingStandard\Tests\PHPStan\Rules\data\Animal|null> instanceof Sourceability\CodingStandard\Tests\PHPStan\Rules\data\Animal" with "null !== expr<Sourceability\CodingStandard\Tests\PHPStan\Rules\data\Animal|null>"',
                15,
            ],
        ]);
    }

    protected function getRule(): Rule
    {
        return new InstanceOfVsNotNullRule(
            new RuleLevelHelper(
                $this->createBroker(),
                true,
                false,
                true
            )
        );
    }
}
