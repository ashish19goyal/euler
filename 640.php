<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('
            Bob plays a single-player game of chance using two standard 6-sided dice 
            and twelve cards numbered 1 to 12. 
            When the game starts, all cards are placed face up on a table.

            Each turn, Bob rolls both dice, getting numbers x and y respectively, 
            each in the range 1,...,6. 
            He must choose amongst three options: 
                turn over card x, card y, or card x+y. 
                (If the chosen card is already face down, 
                it is turned to face up, and vice versa.)

            If Bob manages to have all twelve cards face down at the same time, he wins.

            Alice plays a similar game, except that instead of dice she uses two fair coins, 
            counting heads as 2 and tails as 1, and that she uses four cards instead of twelve. 
            Alice finds that, with the optimal strategy for her game, 
            the expected number of turns taken until she wins is approximately 5.673651.

            Assuming that Bob plays with an optimal strategy, 
            what is the expected number of turns taken until he wins? 
            Give your answer rounded to 6 places after the decimal point.
        ');

// Firstly for Alice's problem        
// winning pattern need exatly one HH and two HTs
// P(A) = P(HH) =.25, P(B) = P(HT) = 0.5, P(C) = P(TT) = 0.25
// winning patterns - ABB, AABB, CABB, BBABB, 
// here order is not important
// result = Sigma(x*f(x)), where 2 < x
// f(x) = P(A)P(B)P(B)*(power(.5,x-3)+sigma(g(y)))


    function solution()
    {
        $result = aliceSolution();

        // $result = combination(6,3);
        $solution = array();
        $solution['complexity'] = "O(n2)";
        $solution['result'] = $result;

        return $solution;
    }

    function aliceSolution(){
        
        $result = 0;
        $x = 3;

        //terminating condition to be based on precision of result
        while($x < 10){
            $result += $x*probability($x);
            $x++;
        }

        return $result;
    }

    function cn($n,$r)
    {
        $result = 1;

        if($n<=$r) return $result;

        $limit = $n-$r;
        while($n>$limit){
            $result*=$n;
            $n--;
        }

        while($r>1){
            $result /= $r;
            $r--;
        }

        return $result;
    }

    function probability($x){
        $prob = 1;

        $prob_primary = cn($x,2)*.25*.25*cn($x-2,1);


        $prob_meta = pow(0.5,$x-3);
        // if($x%2 == 0){
        //     for($y=0;$y<=($x/2)-3;$y++)
        //     {
        //         $prob_meta += cn($x-3,2*$y+1)*pow(.25,2*$y+1)*pow(.5,$x-4-2*$y);
        //     }
        // }
        // else{
        //     for($y=0;$y<=($x-5)/2;$y++)
        //     {
        //         $prob_meta += cn($x-3,2*$y)*pow(.25,2*$y)*pow(.5,$x-3-2*$y);
        //     }
        // }
        print_r("probability of abb combinations = $prob_primary\n");
        print_r("probability of meta combinations = $prob_meta\n");
        $prob = $prob_primary * $prob_meta;

        print_r("x = $x - probability(x) = $prob\n");
        return $prob;
    }

    printSolution(solution());

?>
