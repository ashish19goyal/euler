<?php
include "printProblem.php";
include "printSolution.php";


printProblem('Find the smallest x + y + z with integers x > y > z > 0 
                such that 
                    x + y, x − y, x + z, x − z, y + z, y − z 
                are all perfect squares.');

// comments
//

    function solution($input)
    {
        $result = perfectSquares();

        $solution = array();
        $solution['complexity'] = "O(n3)";
        $solution['result'] = $result;

        return $solution;
    }

    function perfectSquares(){
        for($i=3;true;$i++){
            for($j=2;$j<$i;$j++){
                $a = $i*$i;
                $b = $j*$j;

                if(!isSquare($a-$b)){
                    continue;
                }
                for($k=1;$k<$j;$k++){
                    $c = $k*$k;
                    if($a>$b+$c){
                        continue;
                    }
                    if(($a+$b+$c)%2==1){
                        continue;
                    }
                    if(!isSquare($b-$c) || !isSquare($a-$c)){
                        continue;
                    } 
                    print_r("$a-$b-$c\n");                  
                    return ($a+$b+$c)/2;
                }
            }
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

    printSolution(solution(1));

?>
