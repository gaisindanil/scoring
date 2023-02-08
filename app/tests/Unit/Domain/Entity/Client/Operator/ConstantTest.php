<?php

namespace App\Tests\Unit\Domain\Entity\Client\Operator;

use App\Domain\Client\Entity\Operator\Constant;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ConstantTest extends TestCase
{
    public function testSuccess(){
        $constant = new Constant("MEGAFON");
        Assert::assertNotNull($constant);
    }
}