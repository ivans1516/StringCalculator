<?php

declare(strict_types=1);

namespace Deg540\PHPTestingBoilerplate\Test;

use Deg540\PHPTestingBoilerplate\Calculator;
use PHPUnit\Framework\TestCase;

final class CalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function empty_number(){
        $calculator = new Calculator();

        $result = $calculator->calculate("");

        $this->assertEquals("0", $result);
    }
    /**
     * @test
     */
    public function given_1_number(){
        $calculator = new Calculator();

        $result = $calculator->calculate("1.1");

        $this->assertEquals("1.1", $result);
    }
    /**
     * @test
     */
    public function given_multiple_number(){
        $calculator = new Calculator();

        $result = $calculator->calculate("1.1,2.3,7");

        $this->assertEquals("10.4", $result);
    }
    /**
     * @test
     */
    public function given_wrong_newline(){
        $calculator = new Calculator();

        $result = $calculator->calculate("175.2,\n35");

        $this->assertEquals("Number expected but '\n' found at position 6.", $result);
    }
    /**
     * @test
     */
    public function given_correct_newline(){
        $calculator = new Calculator();

        $result = $calculator->calculate("1\n2,3");

        $this->assertEquals("6", $result);
    }
    /**
     * @test
     */
    public function given_missing_number_last_position(){
        $calculator = new Calculator();

        $result = $calculator->calculate("1,3,");

        $this->assertEquals("Number expected but EOF found.", $result);
    }

    /**
     * @test
     */
    public function given_new_separator_return_3(){
        $calculator = new Calculator();

        $result = $calculator->calculate("//;\n1;2");

        $this->assertEquals("3", $result);
    }
    /**
     * @test
     */
    public function given_new_separator_return_6(){
        $calculator = new Calculator();

        $result = $calculator->calculate("//|\n1|2|3");

        $this->assertEquals("6", $result);
    }
    /**
     * @test
     */
    public function given_new_separator_return_5(){
        $calculator = new Calculator();

        $result = $calculator->calculate("//sep\n2sep3");

        $this->assertEquals("5", $result);
    }
    /**
     * @test
     */
    public function given_new_separator_invalid(){
        $calculator = new Calculator();

        $result = $calculator->calculate("//|\n1|2,3");

        $this->assertEquals("'|' expected but ',' found at position 7.", $result);
    }


}
