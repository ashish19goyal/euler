<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('
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
