<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('Starting in the top left corner of a 2×2 grid, 
                    and only being able to move to the right and down, 
                    there are exactly 6 routes to the bottom right corner.

                    How many such routes are there through a 20×20 grid?
                ');

class solution15{

    private $memory = null;

    public function __construct()
    {
        $this->memory = [];
    }

    function laticePath($x,$y){
        
        if($x<=0 || $y<=0) return 0;
        if($x==1 && $y>0) return $y+1; 
        if($y==1 && $x>0) return $x+1; 

        if(isset($this->memory["$x.$y"])){
            return $this->memory["$x.$y"];
        }

        $calculated = $this->laticePath($x-1,$y) + $this->laticePath($x,$y-1);
        $this->memory["$x.$y"] = $calculated;
        $this->memory["$y.$x"] = $calculated;
        return $calculated;
    }

    function solution($input)
    {
        $result = $this->laticePath($input,$input);

        $solution = array();
        $solution['complexity'] = "Dynamic programming";
        $solution['result'] = $result;

        return $solution;
    }
}

$solution = new solution15();
printSolution($solution->solution(20));

?>
