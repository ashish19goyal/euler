<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('The sum of the primes below 10 is 2 + 3 + 5 + 7 = 17.
                Find the sum of all the primes below two million.
                ');

// calculate the sum of all numbers upto 2 million
// using Sieve of Eratosthenes, start subtracting non-prime numbers from it
// Sieve of Eratosthenes - starting from smallest prime, mark all multiples of the number, 
// greater than square of the number as non prime. 
// Then choose the next prime as the new number 

    function solution($input)
    {
        $result = 0;

        $array = array();

        //initializing the array
        for($i = 2; $i < $input; $i++){
            $array[$i] = 1;    
        }

        //setting non primes
        $prime = 2;
        while($prime<$input && $prime !=0){
            $primeSquare = pow($prime,2);
            $multiplier = floor(($input - $primeSquare)/$prime);
            for($i=0;$i<=$multiplier;$i++){
                $array[$primeSquare+$prime*$i] = 0;
            }
            $prime = leastPrime($array,$prime);
            // print_r($prime."\n");
        }

        //finding sum of primes
        // print_r($array);
        for($i = 2; $i < $input; $i++){
            if($array[$i]==1)
                $result += $i;
        }

        $solution = array();
        $solution['complexity'] = "O(nlogn)";
        $solution['result'] = $result;

        return $solution;
    }

    function leastPrime($array,$prime){
        for($i = $prime+1; $i<count($array);$i++){
            if($array[$i]==1)
            {
                return $i;
            }
        }
        return 0;
    }

    printSolution(solution(2000000));

?>
