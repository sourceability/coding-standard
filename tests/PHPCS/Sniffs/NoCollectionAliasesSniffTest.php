<?php

namespace Sourceability\CodingStandard\Tests\PHPCS\Sniffs;

use PHP_CodeSniffer\Files\File;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Sourceability\CodingStandard\PHPCS\Sniffs\NoCollectionAliasesSniff;

class NoCollectionAliasesSniffTest extends TestCase
{
    use ProphecyTrait;

    public function testSimpleAverage(): void
    {
        $stackPtr = 3; // The location of the first '->'
        $file = $this->prophesize(File::class);
        $file->getTokens()->willReturn([['content' => 'collect'], ['content' => '('],['content' => ')'],['content' => '->'],['content' => 'average'],['content' => '('], ['content' => ')']]);
        $file->findPrevious(T_STRING, 2, null, false, 'collect', true)->willReturn(0);

        $file->addError('Use of collection method alias "average" is forbidden, use "avg" instead', $stackPtr, 'ForbiddenAlias')->shouldBeCalled();

        $sniff = new NoCollectionAliasesSniff();
        $sniff->process($file->reveal(), $stackPtr);
    }

    public function testSimpleSome(): void
    {
        $stackPtr = 3; // The location of the first '->'
        $file = $this->prophesize(File::class);
        $file->getTokens()->willReturn([['content' => 'collect'], ['content' => '('],['content' => ')'],['content' => '->'],['content' => 'some'],['content' => '('], ['content' => ')']]);
        $file->findPrevious(T_STRING, 2, null, false, 'collect', true)->willReturn(0);

        $file->addError('Use of collection method alias "some" is forbidden, use "contains" instead', $stackPtr, 'ForbiddenAlias')->shouldBeCalled();

        $sniff = new NoCollectionAliasesSniff();
        $sniff->process($file->reveal(), $stackPtr);
    }

    public function testSimpleUnlessEmpty(): void
    {
        $stackPtr = 3; // The location of the first '->'
        $file = $this->prophesize(File::class);
        $file->getTokens()->willReturn([['content' => 'collect'], ['content' => '('],['content' => ')'],['content' => '->'],['content' => 'unlessEmpty'],['content' => '('], ['content' => ')']]);
        $file->findPrevious(T_STRING, 2, null, false, 'collect', true)->willReturn(0);

        $file->addError('Use of collection method alias "unlessEmpty" is forbidden, use "whenNotEmpty" instead', $stackPtr, 'ForbiddenAlias')->shouldBeCalled();

        $sniff = new NoCollectionAliasesSniff();
        $sniff->process($file->reveal(), $stackPtr);
    }


    public function testSimpleUnlessNotEmpty(): void
    {
        $stackPtr = 3; // The location of the first '->'
        $file = $this->prophesize(File::class);
        $file->getTokens()->willReturn([['content' => 'collect'], ['content' => '('],['content' => ')'],['content' => '->'],['content' => 'unlessNotEmpty'],['content' => '('], ['content' => ')']]);
        $file->findPrevious(T_STRING, 2, null, false, 'collect', true)->willReturn(0);

        $file->addError('Use of collection method alias "unlessNotEmpty" is forbidden, use "whenEmpty" instead', $stackPtr, 'ForbiddenAlias')->shouldBeCalled();

        $sniff = new NoCollectionAliasesSniff();
        $sniff->process($file->reveal(), $stackPtr);
    }

    public function testMoreAdvancedCase(): void
    {
        $badLine = 'collect($foo)->average(static fn (User $user) => $user->getId());';

        $stackPtr = 4; // The location of the first '->'
        $file = $this->prophesize(File::class);
        $file->getTokens()->willReturn([['content' => 'collect'], ['content' => '('],['content' => '$foo'],['content' => ')'],['content' => '->'],['content' => 'average'],['content' => '('],['content' =>  'static'], ['content' => 'fn'],        ['content' => '('], ['content' => 'User'], ['content' => '$user'], ['content' => ')'], ['content' => '=>'], ['content' => '$user'], ['content' => '->'], ['content' => 'getId'], ['content' => '('], ['content' => ')'], ['content' => ')']]);
        $file->findPrevious(T_STRING, 3, null, false, 'collect', true)->willReturn(0);

        $file->addError('Use of collection method alias "average" is forbidden, use "avg" instead', $stackPtr, 'ForbiddenAlias')->shouldBeCalled();

        $sniff = new NoCollectionAliasesSniff();
        $sniff->process($file->reveal(), $stackPtr);
    }
}
