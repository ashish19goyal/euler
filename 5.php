<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('2520 is the smallest number that can be divided by 
                    each of the numbers from 1 to 10 without any remainder.
                    What is the smallest positive number that is evenly divisible by 
                    all of the numbers from 1 to 20?
                ');

// get list of factors of every number                
// create a list of maximum factors of all numbers till 20
// multiply all  of them to get the number

    function solution($input)
    {
        $result = 1;

        $factorsList = array();

        for($i = 2; $i<=$input; $i++)
        {
            $factors = getFactor($i);
            foreach($factors as $k=>$f)
            {
                if(!isset($factorsList[$k])){
                    $factorsList[$k] = $f;
                }else{
                    $factorsList[$k] = max($factorsList[$k],$f);
                }
            }
            // print_r("Final array - ");
            // print_r($factorsList);
        }

        foreach($factorsList as $k=>$f)
        {
            $result = $result * pow($k,$f);
        }

        $solution = array();
        $solution['complexity'] = "O(nlogn)";
        $solution['result'] = $result;

        return $solution;
    }

    function getFactor($number)
    {
        $factorsList = array();
        for($i = 2; $i <= $number;)
        {
            if($number%$i ==0)
            {
                if(isset($factorsList[$i]))
                    $factorsList[$i] += 1; 
                else
                    $factorsList[$i] = 1; 
                
                $number = $number/$i;
                if($number <= 1){
                    break;
                }
            }else{
                $i++;
            }
        }

        // print_r("Number array - ");
        // print_r($factorsList);
        return $factorsList;
    }
    
    printSolution(solution(20));

?>
