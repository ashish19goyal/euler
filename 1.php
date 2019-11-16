<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('If we list all the natural numbers below 10 
                that are multiples of 3 or 5, we get 3, 5, 6 and 9. 
                The sum of these multiples is 23. 
                Find the sum of all the multiples of 3 or 5 below 1000.
                ');

// 3+6+9+12+15....999 = 3(1+2+3...333) = 3*333*334/2 
// 5+10+15+20+....995 = 5(1+2+3...199) = 5*199*200/2
// 15+30+45+......990 = 15(1+2+3..66) = 15*66*67/2

    function solution($input)
    {
        $n = $input - 1; //less than the input
        $max3 = floor($n/3);
        $max5 = floor($n/5);
        $max15 = floor($n/15);

        $sum3 = 3*$max3*($max3+1)/2;
        $sum5 = 5*$max5*($max5+1)/2;
        $sum15 = 15*$max15*($max15+1)/2;

        $result = $sum3+$sum5-$sum15;

        $solution = array();
        $solution['complexity'] = "O(1)";
        $solution['result'] = $result;

        return $solution;
    }

    printSolution(solution(1000));

?>
