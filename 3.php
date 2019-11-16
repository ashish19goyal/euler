<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('The prime factors of 13195 are 5, 7, 13 and 29.
                    What is the largest prime factor of the number 600851475143 ?
                ');

// find all divisors of the number
// starting from the largest divisor, start finding divisors of each
// if a divisor doesn't have divisors, break and return

    function solution($input)
    {
        $result = 1;

        $divisors_desc = array();
        $divisors_asc = array();
        $divisor_limit = $input;

        for($i = 2; $i < $divisor_limit; $i++){
            if($input % $i == 0){
                $divisor_limit = $input/$i;
                $divisors_desc[] = $divisor_limit;
                $divisors_asc[] = $i;
            }
        }
        //complexity O(n)
        
        $divisors = array_merge($divisors_desc,array_reverse($divisors_asc));
        print_r($divisors);

        //if no divisors exist, the number itself is prime
        if(count($divisors)==0){
            $result = $input;
        }

        //finding prime number in divisors list
        //starting from highest
        for($d = 0; $d < count($divisors); $d++)
        {
            $isPrime = true;
            $divisor_limit = $divisors[$d];

            //if any divisor is found, number is not prime
            for($x = 2; $x<$divisor_limit;$x++)
            {
                if($divisors[$d] % $x == 0){
                    $isPrime = false;
                    print_r($divisors[$d]. "is not prime\n divisor ". $x. "\n");
                    break;
                }
            }

            if($isPrime){
                $result = $divisors[$d];
                break;
            }
        }

        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $result;

        return $solution;
    }

    printSolution(solution(600851475143));

?>
