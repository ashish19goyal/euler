<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('The minimal path sum in the 5 by 5 matrix below, 
    by starting in any cell in the left column and finishing in any cell in the right column, 
    and only moving up, down, and right, is indicated in red and bold; the sum is equal to 994.

 
    Find the minimal path sum from the left column to the right column in matrix.txt 
    (right click and "Save Link/Target As..."), a 31K text file containing an 80 by 80 matrix.');

    function solution()
    {
        $input = readMyFile("82.txt");
        $dp = array();
        for($i=0; $i<count($input); $i++){
            $dp[$i] = array();
            $dp[$i][0] = $input[$i][0];
        }

        $n = count($input);
        for($j=1; $j<$n; $j++){

            $dp[0][$j] = $input[0][$j] + $dp[0][$j-1];

            for($i=1;$i<$n;$i++){
                $topTerm = $dp[$i-1][$j] + $input[$i][$j];
                $leftTrem = $dp[$i][$j-1] + $input[$i][$j];
                $dp[$i][$j] = min($topTerm,$leftTrem);
            }

            $dp[$n-1][$j] = min($dp[$n-1][$j],$input[$n-1][$j] + $dp[$n-1][$j-1]);
            for($i=$n-2;$i>=0;$i--){
                $bottomTerm = $dp[$i+1][$j] + $input[$i][$j];
                $leftTrem = $dp[$i][$j-1] + $input[$i][$j];
                $dp[$i][$j] = min($bottomTerm,$leftTrem,$dp[$i][$j]);
            }
        }

        $min = $dp[0][$n-1];
        for($k=0;$k<$n;$k++){
            $min = min($min,$dp[$k][$n-1]);
        }

        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $min;

        return $solution;
    }

    function readMyFile($filename){
        $input = array();
        $myfile = fopen($filename, "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            $line = fgets($myfile);
            $numbers = explode(",",$line);
            for($i = 0; $i< count($numbers); $i++){
                $numbers[$i] = intval($numbers[$i]);
            }
            $input[] = $numbers;
        }
        fclose($myfile);
        return $input;
    }

    printSolution(solution());

?>
