<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('The decimal number, 585 = 10010010012 (binary), is palindromic in both bases.
        Find the sum of all numbers, less than one million, 
        which are palindromic in base 10 and base 2.
    
        (Please note that the palindromic number, in either base, may not include leading zeros.)
    ');

// comments
//

    function solution($input)
    {
        $result = 999999;

        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $result;

        return $solution;
    }

    printSolution(solution(1));

?>
