<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('A palindromic number reads the same both ways. 
                    The largest palindrome made from the product of two 2-digit numbers is 9009 = 91 × 99.
                    Find the largest palindrome made from the product of two 3-digit numbers.
                ');

// find all divisors of the number
// starting from the largest divisor, start finding divisors of each
// if a divisor doesn't have divisors, break and return

    function solution($input)
    {
        $result = 999999;

        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $result;

        return $solution;
    }

    printSolution(solution(600851475143));

?>
