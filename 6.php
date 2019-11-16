<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('The sum of the squares of the first ten natural numbers is,
                        12 + 22 + ... + 102 = 385
                    The square of the sum of the first ten natural numbers is,
                        (1 + 2 + ... + 10)2 = 552 = 3025
                    Hence the difference between the sum of the squares of the first ten natural numbers 
                    and the square of the sum is 3025 − 385 = 2640.
                    Find the difference between the sum of the squares of the first one hundred natural numbers 
                    and the square of the sum.
                ');

// Sigma(n) = n*(n+1)/2
// sigma(square(n)) = n(n+1)(2n+1)/6

    function solution($input)
    {
        $sigmaN = pow($input*($input+1)/2,2);
        $sigmaN2 = $input*($input+1)*(2*$input+1)/6;

        $result = $sigmaN - $sigmaN2;

        $solution = array();
        $solution['complexity'] = "O(1)";
        $solution['result'] = $result;

        return $solution;
    }

    printSolution(solution(100));

?>
