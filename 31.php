<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('In England the currency is made up of pound, £, and pence, p, 
                and there are eight coins in general circulation:
                1p, 2p, 5p, 10p, 20p, 50p, £1 (100p) and £2 (200p).

                It is possible to make £2 in the following way:    
                1×£1 + 1×50p + 2×20p + 1×5p + 1×2p + 3×1p

                How many different ways can £2 be made using any number of coins?    
                ');

// 
//

    function solution($input)
    {
        $result = 0;

        $coins = array(100,50,20,10,5,2,1);
        for($i=0; $i<count($coins);$i++){
            $coins[$i] = array($coins[$i],floor($input/$coins[$i]));
        }
        // print_r($coins);

        for($a=0;$a<=$coins[0][1];$a++){
            for($b=0;$b<=$coins[1][1];$b++){
                if($coins[1][0]*$a+$coins[1][0]*$b > $input){
                    break;
                }
                for($c=0;$c<=$coins[2][1];$c++){
                    if($coins[0][0]*$a+$coins[1][0]*$b+$coins[2][0]*$c > $input){
                        break;
                    }
                    for($d=0;$d<=$coins[3][1];$d++){
                        if($coins[0][0]*$a+$coins[1][0]*$b+$coins[2][0]*$c+$coins[3][0]*$d > $input){
                            break;
                        }
                        for($e=0;$e<=$coins[4][1];$e++){
                            if($coins[0][0]*$a+$coins[1][0]*$b+$coins[2][0]*$c+$coins[3][0]*$d+$coins[4][0]*$e > $input){
                                break;
                            }
                            for($f=0;$f<=$coins[5][1];$f++){
                                if($coins[0][0]*$a+$coins[1][0]*$b+$coins[2][0]*$c+$coins[3][0]*$d+$coins[4][0]*$e+$coins[5][0]*$f > $input){
                                    break;
                                }
                                $oneCoins = $input - ($coins[0][0]*$a+$coins[1][0]*$b+$coins[2][0]*$c+$coins[3][0]*$d+$coins[4][0]*$e+$coins[5][0]*$f);
                                print_r($coins[0][0]."*".$a."+".$coins[1][0]."*".$b."+".$coins[2][0]."*".$c."+".$coins[3][0]."*".$d."+".$coins[4][0]."*".$e."+".$coins[5][0]."*".$f."+".$coins[6][0]."*".$oneCoins."\n");
                                $result++;
                            }
                        }
                    }
                }
            }
        }        
        //for the 2# coin
        $result++;
        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $result;

        return $solution;
    }

    printSolution(solution(200));

?>
