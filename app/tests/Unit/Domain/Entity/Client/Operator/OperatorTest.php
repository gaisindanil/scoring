<?php

namespace App\Tests\Unit\Domain\Entity\Client\Operator;

use App\Domain\Client\Entity\Operator\Constant;
use App\Domain\Client\Entity\Operator\Operator;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class OperatorTest extends TestCase
{
    public function testSuccess(){
        $operator = new Operator(
            $name = "Мегафон",
            $constant = Constant::megafon(),
            $grade = 5
        );

        Assert::assertEquals($operator->getName(), $name);
        Assert::assertEquals($operator->getConstant(), $constant);
        Assert::assertEquals($operator->getGrade(), $grade);
    }

}