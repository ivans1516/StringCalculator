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
        else{
            $suma=0;
            $position=0;
            $porciones =explode(",",$stringWithNumbers);
            foreach ($porciones as $stringNumber){
                if(str_starts_with($stringNumber,"\n")){
                    return "Number expected but '\n' found at position ".$position.".";
                }
                else{
                    if(str_contains($stringNumber,"\n")){
                        $porciones2=explode("\n",$stringNumber);
                        $suma=$suma+floatval($porciones2[0])+floatval($porciones2[1]);

                    }
                    else{
                        $suma=$suma+floatval($stringNumber);
                    }
                }
                $position=$position+strlen($stringNumber)+1;
            }
            return strval("$suma");
        }
    }

}