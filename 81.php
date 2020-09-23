<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('In the 5 by 5 matrix below, 
    the minimal path sum from the top left to the bottom right, 
    by only moving to the right and down, 
    is indicated in bold red and is equal to 2427.

 
    Find the minimal path sum from the top left to the bottom right by only moving 
    right and down in matrix.txt (right click and "Save Link/Target As..."), 
    a 31K text file containing an 80 by 80 matrix.');

    function solution()
    {
        $input = readMyFile("81.txt");
        for($i=0; $i<count($input); $i++){
           for($j=0;$j<count($input);$j++){
                $min = 0;
                if($i>0){
                    $min = $input[$i-1][$j];
                }
                if($j>0 && ($input[$i][$j-1]<$min || $min==0)){
                    $min = $input[$i][$j-1];
                }
                $input[$i][$j] = $input[$i][$j] + $min;
            }
        }

        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $input[count($input)-1][count($input)-1];

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
