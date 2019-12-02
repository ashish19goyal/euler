<?php

require_once 'vendor/autoload.php';
include "printProblem.php";
include "printSolution.php";
include "queue.php";


    printProblem('Find the smallest x + y + z with integers x > y > z > 0 
                    such that 
                        x + y, x − y, x + z, x − z, y + z, y − z 
                    are all perfect squares.');

// comments
// using dynamic programming

    function solution()
    {
        $result = 999999;

        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $result;

        $queue = new rabbitmq("142_queue");
        $queue->publish("hi");
        $queue->listen();

        return $solution;
    }

    function perfectSquareCollection($x,$y,$z){
        if(isSquare($x+$y) && isSquare($x-$y) && isSquare($x+$z) && isSquare($x-$z) && isSquare($y+$z) && isSquare($y-$z)){
            return $x+$y+$z;
        }
        else{
            return perfectSquareCollection($x++,$y,$z);
        }
    }

    function isSquare($number){
        for($i = 1; $i*$i<=$number;$i++){
            if($i*$i==$number){
                return true;
            }
        }
        return false;
    }

    printSolution(solution());

?>
