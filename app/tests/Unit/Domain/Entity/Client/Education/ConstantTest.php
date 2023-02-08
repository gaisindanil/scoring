<?php

namespace App\Tests\Unit\Domain\Entity\Client\Education;

use App\Domain\Client\Entity\Education\Constant;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ConstantTest extends TestCase
{
    public function testSuccess(){
        $constant = new Constant("AVERAGE");
        Assert::assertNotNull($constant);
    }
}