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
    public function empty_String(){
        $calculator = new Calculator();

        $result = $calculator->calculate("");

        $this->assertEquals("0", $result);
    }

    /**
     * @test
     */
    public function all_errors_posibilities_deafult_separator(){
        $calculator = new Calculator();

        $result = $calculator->calculate("-1,,2,4.5|6,\n3,");

        $this->assertEquals("Negative not allowed: -1\nNumber expected but ',' found at position 3\n',' expected but '|' found at position 9.\nNumber expected but '\n' found at position 12.\nNumber expected but EOF found.", $result);
    }

    /**
     * @test
     */
    public function all_errors_posibilities_diferent_separator(){
        $calculator = new Calculator();

        $result = $calculator->calculate("//|\n-1||2|4.5,6|\n3|");

        $this->assertEquals("Negative not allowed: -1\nNumber expected but '|' found at position 7\n'|' expected but ',' found at position 13.\nNumber expected but '\n' found at position 16.\nNumber expected but EOF found.", $result);
    }

    /**
     * @test
     */
    public function all_posibilities_default_separator(){
        $calculator = new Calculator();

        $result = $calculator->calculate("4.3,5\n,8.1");

        $this->assertEquals("17.4",$result);
    }

    /**
     * @test
     */
    public function all_posibilities_diferent_separator(){
        $calculator = new Calculator();

        $result = $calculator->calculate("//|\n4.3|5\n|8.1");

        $this->assertEquals("17.4",$result);
    }

}
