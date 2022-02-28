<?php

namespace Deg540\PHPTestingBoilerplate;



class Calculator
{


    public function calculate(string $stringToOperate): string
    {
        $errorsArray=array();
        if(empty($stringToOperate))
            return 0;
        else{
            $finalResult=0;
            $actualStringPosition=0;
            $delimiterPosition=$this->get_Delimiter_Indexes($stringToOperate);
            $delimiter=$this->get_Delimiter($stringToOperate,$delimiterPosition);
            if($delimiterPosition>0){
                $actualStringPosition=$delimiterPosition+1;
            }
            $tokensByDelimiter =explode($delimiter,substr($stringToOperate,$actualStringPosition,strlen($stringToOperate)-$actualStringPosition));
            $tokensByDemiliterCounter=0;
            foreach ($tokensByDelimiter as $tokenByDemiliter){
                $tokensByDemiliterCounter=$tokensByDemiliterCounter+1;
                if($tokensByDemiliterCounter>1){
                    $actualStringPosition=$actualStringPosition+1;
                }
                if(str_starts_with($tokenByDemiliter,"\n")){
                    $errorsArray[] = "Number expected but '\n' found at position " . $actualStringPosition . ".";
                    $actualStringPosition=$actualStringPosition+strlen($tokenByDemiliter);
                }
                else{
                    $tokensByNewLine=explode("\n",$tokenByDemiliter);
                    $tokensByNewLineCounter=0;
                    foreach ($tokensByNewLine as $tokenByNewLine){
                        $tokensByNewLineCounter=$tokensByNewLineCounter+1;
                        if($tokensByNewLineCounter>1){
                            $actualStringPosition=$actualStringPosition+1;
                        }
                        else{
                            if(empty($tokenByNewLine)){
                                if(strlen($stringToOperate)<=$actualStringPosition){
                                    $errorsArray[] = "Number expected but EOF found.";
                                }
                                else{
                                    $errorsArray[] = "Number expected but '" . $delimiter . "'" . " found at position " . $actualStringPosition;
                                }
                            }
                            else{
                                if(is_numeric($tokenByNewLine)){
                                    if(str_contains($tokenByNewLine,"-")){
                                        for ($newlineTokenCharacter = 0; $newlineTokenCharacter < strlen($tokenByNewLine); $newlineTokenCharacter++) {
                                            if($tokenByNewLine[$newlineTokenCharacter]=="-"){
                                                $errorsArray[] = "Negative not allowed: " . $tokenByNewLine[$newlineTokenCharacter] . $tokenByNewLine[$newlineTokenCharacter + 1];
                                            }
                                        }
                                    }
                                    else{
                                        $finalResult=$finalResult+floatval($tokenByNewLine);
                                    }
                                }
                                else{
                                    for ($newlineTokenCharacter = 0; $newlineTokenCharacter < strlen($tokenByNewLine); $newlineTokenCharacter++) {
                                        if(!(is_numeric($tokenByNewLine[$newlineTokenCharacter]) or $tokenByNewLine[$newlineTokenCharacter]=="."))
                                            $errorsArray[] = "'" . $delimiter . "'" . " expected but '" . $tokenByNewLine[$newlineTokenCharacter] . "'" . " found at position " . $actualStringPosition + $newlineTokenCharacter . ".";
                                    }
                                }
                            }
                            $actualStringPosition=$actualStringPosition+strlen($tokenByNewLine);
                        }
                    }
                }
            }
            return $this->show_results($errorsArray,$finalResult);
        }
    }

    private function get_Delimiter_Indexes($stringToOperate):int{
        if(str_starts_with($stringToOperate,"//") and str_contains($stringToOperate,"\n")){
            return strpos($stringToOperate,"\n");
        }
        else{
            return 0;
        }
    }

    private function get_Delimiter($stringToOperate,$delimiter_position):string
    {
        if($delimiter_position>0){
            return substr($stringToOperate, 2, $delimiter_position-2);
        }
        else{
            return ",";
        }
    }

    private function show_results($errorsArray,$result):string
    {
        if(empty($errorsArray)){
            return strval($result);
        }
        else{
            $errorsMessage="";
            foreach ($errorsArray as &$error) {
                $errorsMessage = $errorsMessage.$error."\n";
            }
            return substr($errorsMessage,0,-1);
        }
    }

}