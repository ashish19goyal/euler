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

// Will be using dynamic programming to solve this problem
// form mathemtical function for the series
// combinations(sum,maxCoin) represents the number of combinations of coins (with maximum coin as maxCoin) 
// that forms the sum

    function solution($input)
    {
        //memory remembers the combinations for a specific input
        $memory = array();

        $result = combinations($input,$input,$memory);
        // print_r($memory);
        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $result;

        return $solution;
    }

    function combinations($sum,$maxCoin, &$memory){
        //check if memory already has the output
        if(isset($memory[$sum."-".$maxCoin]))
        {
            // print_r($sum."-".$maxCoin." found in memory \n");
            return $memory[$sum."-".$maxCoin];
        }

        //finding next highest coin
        $coins = array(1,2,5,10,20,50,100,200);
        $indexCurrentCoin = array_search($maxCoin,$coins);
        // print_r("indexCurrentCoin-".$indexCurrentCoin."\n");

        $result = 0;

        if($sum%$maxCoin == 0)
        {
            $result = 1;
        }

        //if next coin is available
        if($indexCurrentCoin > 0)
        {
            $penultimateCoin = $coins[$indexCurrentCoin-1];
            $interimSum = $sum;            
            //calculating output through recursion
            while($interimSum > 0){
                $result += combinations($interimSum,$penultimateCoin,$memory);
                $interimSum -= $maxCoin;
            }
        }

        //saving the result in memory
        $memory[$sum."-".$maxCoin] = $result;
        return $result;
    }

    printSolution(solution(200));

?>
