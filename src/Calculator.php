<?php

namespace Deg540\PHPTestingBoilerplate;



class Calculator
{
    public function calculate(string $stringToOperate): string
    {
        if(empty($stringToOperate)) {
            return 0;
        }
        else{
            $result=0;
            $actualPosition=0;
            $delimiterPosition=$this->get_Delimiter_Indexes($stringToOperate);
            $delimiter=$this->get_Delimiter($stringToOperate,$delimiterPosition);
            if($delimiterPosition>0){
                $actualPosition=$delimiterPosition+1;
            }

            $tokens =explode($delimiter,substr($stringToOperate,$actualPosition,strlen($stringToOperate)-$actualPosition));
            $tokensCounter=0;
            foreach ($tokens as $token){
                $tokensCounter=$tokensCounter+1;
                if($tokensCounter>1){
                    $actualPosition=$actualPosition+1;
                }
                if(empty($token)){
                    return "Number expected but EOF found.";
                }
                elseif(str_starts_with($token,"\n")){
                    return "Number expected but '\n' found at position ".$actualPosition.".";
                }
                else{
                    $newlineTokens=explode("\n",$token);
                    $newlineTokensCounter=0;
                    foreach ($newlineTokens as $newlineToken){
                        $newlineTokensCounter=$newlineTokensCounter+1;
                        if($newlineTokensCounter>1){
                            $actualPosition=$actualPosition+1;
                        }
                        if(empty($newlineToken)){
                            if(strlen($stringToOperate)<=$actualPosition){
                                return "Number expected but EOF found.";
                            }
                            else{
                                return "Number expected but '".$delimiter."'"." found at position ".$actualPosition;
                            }
                        }
                        if(is_numeric($newlineToken)){
                            $result=$result+floatval($newlineToken);
                        }
                        else{
                            for ($newlineTokenCharacter = 0; $newlineTokenCharacter < strlen($newlineToken); $newlineTokenCharacter++) {
                                if(!(is_numeric($newlineToken[$newlineTokenCharacter]) or $newlineToken[$newlineTokenCharacter]==".")){
                                    return "'".$delimiter."'"." expected but '".$newlineToken[$newlineTokenCharacter]."'"." found at position ".$actualPosition+$newlineTokenCharacter.".";
                                }
                            }
                        }
                        $actualPosition=$actualPosition+strlen($newlineToken);

                    }
                }
            }
            return strval("$result");
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

}