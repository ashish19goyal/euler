<?php
include "printProblem.php";
include "printSolution.php";


    printProblem('In the game, Monopoly, the standard board is set up in the following way:

    p084_monopoly_board.png
    A player starts on the GO square and adds the scores on two 6-sided dice to determine the number of squares they advance in a clockwise direction. Without any further rules we would expect to visit each square with equal probability: 2.5%. However, landing on G2J (Go To Jail), CC (community chest), and CH (chance) changes this distribution.
    
    In addition to G2J, and one card from each of CC and CH, that orders the player to go directly to jail, if a player rolls three consecutive doubles, they do not advance the result of their 3rd roll. Instead they proceed directly to jail.
    
    At the beginning of the game, the CC and CH cards are shuffled. When a player lands on CC or CH they take a card from the top of the respective pile and, after following the instructions, it is returned to the bottom of the pile. There are sixteen cards in each pile, but for the purpose of this problem we are only concerned with cards that order a movement; any instruction not concerned with movement will be ignored and the player will remain on the CC/CH square.
    
    Community Chest (2/16 cards):
    Advance to GO
    Go to JAIL
    Chance (10/16 cards):
    Advance to GO
    Go to JAIL
    Go to C1
    Go to E3
    Go to H2
    Go to R1
    Go to next R (railway company)
    Go to next R
    Go to next U (utility company)
    Go back 3 squares.
    The heart of this problem concerns the likelihood of visiting a particular square. That is, the probability of finishing at that square after a roll. For this reason it should be clear that, with the exception of G2J for which the probability of finishing on it is zero, the CH squares will have the lowest probabilities, as 5/8 request a movement to another square, and it is the final square that the player finishes at on each roll that we are interested in. We shall make no distinction between "Just Visiting" and being sent to JAIL, and we shall also ignore the rule about requiring a double to "get out of jail", assuming that they pay to get out on their next turn.
    
    By starting at GO and numbering the squares sequentially from 00 to 39 we can concatenate these two-digit numbers to produce strings that correspond with sets of squares.
    
    Statistically it can be shown that the three most popular squares, in order, are JAIL (6.24%) = Square 10, E3 (3.18%) = Square 24, and GO (3.09%) = Square 00. So these three most popular squares can be listed with the six-digit modal string: 102400.
    
    If, instead of using two 6-sided dice, two 4-sided dice are used, find the six-digit modal string.');

    function solution($runs)
    {
        // initialize visited nodes to zero
        $visited = array();
        for($i=0;$i<40;$i++){
            $visited[$i]=0;
        }

        $chance = array(-1,-1,-1,0,-1,10,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);

        $community = array(0,10,11,24,39,5,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1);

        $actualRun = 0;
        $start = 0;
        $chanceCount = 0;
        $communityCount = 0;
        while($actualRun<$runs){
            $runResult = run($start,$visited,0, $chance, $community, $chanceCount, $communityCount);
            $start = $runResult[0];
            $chanceCount = $runResult[1];
            $communityCount = $runResult[2];
            $visited = $runResult[3];
            $actualRun++;
        }

        print_r($visited);

        arsort($visited);

        print_r($visited);

        $result = "";
        $keys = array_keys($visited);
        for($i=0;$i<3;$i++){
            $result .= $keys[$i];
        }
        $solution = array();
        $solution['complexity'] = "Statistical";
        $solution['result'] = $result;

        return $solution;
    }

    function run($start, $visited, $doubles, $chance, $community, $chanceCount, $communityCount){
        $one = rand(1,4);
        $two = rand(1,4);

        //doubles
        if($one==$two){
            $doubles++;
            $next = ($start + $one + $two)%40;
            if($doubles==3 || $next==10){
                $next = 10;
                $doubles = 0;
                $visited[$next]++;
                return array($next,$chanceCount,$communityCount,$visited);
            }
            return run($next, $visited, $doubles, $chance, $community, $chanceCount, $communityCount);
        }
        
        $next = ($start + $one + $two)%40;

        // go to jail
        if($next == 30) $next = 10;
        //chance
        else if($next == 7 || $next == 22 || $next == 36){
            $chanceValue = $chance[$chanceCount];
            if($chanceValue>-1) $next = $chanceValue;
            $chanceCount = ($chanceCount+1)%16;
        }
        // community
        else if($next == 2 || $next == 17 || $next == 33){
            if($communityCount==6 || $communityCount==7){
                if($next==2) $next = 5;
                else if($next == 17) $next = 25;
                else if($next == 33) $next = 35;
            }
            else if($communityCount==8){
                if($next<12) $next = 12;
                else if($next<28) $next = 28;
            }
            else if($communityCount==9){
                $next -= 3;
                if($next<0) $next+=40;
            }
            else{
                $communityValue = $community[$communityCount];
                if($communityValue>-1) $next = $communityValue;
            }
            $communityCount = ($communityCount+1)%16;
        }

        $visited[$next]++;
        return array($next,$chanceCount,$communityCount,$visited);
    }

    printSolution(solution(100000000));

?>
