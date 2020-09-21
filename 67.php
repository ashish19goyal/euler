<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('By starting at the top of the triangle below and moving to adjacent numbers on the row below, the maximum total from top to bottom is 23.

    3
    7 4
    2 4 6
    8 5 9 3
    
    That is, 3 + 7 + 4 + 9 = 23.
    
    Find the maximum total from top to bottom in triangle.txt (), a 15K text file containing a triangle with one-hundred rows.
    
    ');

    function solution()
    {
        $input = readMyFile("67.txt");
        for($i=count($input)-2; $i>=0; $i--){
           for($j=0;$j<=$i;$j++){
                if($input[$i+1][$j] > $input[$i+1][$j+1])
                    $input[$i][$j] = $input[$i][$j] + $input[$i+1][$j];
            else {
                    $input[$i][$j] = $input[$i][$j] + $input[$i+1][$j+1];
                }
            }
        }

        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $input[0][0];

        return $solution;
    }

    function readMyFile($filename){
        $input = array();
        $myfile = fopen($filename, "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            $line = fgets($myfile);
            $numbers = explode(" ",$line);
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
