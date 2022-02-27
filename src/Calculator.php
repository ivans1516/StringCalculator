<?php

namespace Deg540\PHPTestingBoilerplate;

use function PHPUnit\Framework\isEmpty;

class Calculator
{
    public function calculate(string $stringWithNumbers): string
    {
        if(empty($stringWithNumbers)){
            return "0";
        }
        elseif (is_numeric($stringWithNumbers)){
            return $stringWithNumbers;
        }
        else{
            $suma=0;
            $porciones =explode(",",$stringWithNumbers);
            foreach ($porciones as $stringNumber){
                $suma=$suma+floatval($stringNumber);
            }
            return strval("$suma");
        }
    }

}