<?php

namespace App\Tests\Unit\Domain\Entity\Client\Education;

use App\Domain\Client\Entity\Education\Constant;
use App\Domain\Client\Entity\Education\Education;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class EducationTest extends TestCase
{
    public function testSuccess(){
        $education = new Education(
            $name = "Среднее",
            $constant = Constant::average(),
            $grade = 5
        );

        Assert::assertEquals($education->getName(), $name);
        Assert::assertEquals($education->getConstant(), $constant);
        Assert::assertEquals($education->getGrade(), $grade);
    }


}