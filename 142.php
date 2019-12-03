<?php

require_once 'vendor/autoload.php';
include "printProblem.php";
include "printSolution.php";
include "queue.php";


    printProblem('Find the smallest x + y + z with integers x > y > z > 0 
                    such that 
                        x + y, x − y, x + z, x − z, y + z, y − z 
                    are all perfect squares.');

class solution142{

    private $queue = null;    
    private $resultFile = null;
    private $squaresMap = null;

    public function __construct()
    {
        $this->queue = new rabbitmq("142_queue");    
        $this->resultFile = fopen("142_result.txt", "w");
        $this->squaresMap = [];
    }

    public function solution()
    {
        $msg = [];
        $msg['x'] = 3;
        $msg['y'] = 2;
        $msg['z'] = 1;

        fwrite($this->resultFile, "Starting processing with - ".json_encode($msg)."\n");
        
        $this->queue->publish($msg);
        $this->queue->listen(array($this,'perfectSquareCollection'));
    }

    function perfectSquareCollection($amqpMsg){
        fwrite($this->resultFile, "Checking for - $amqpMsg->body \n");

        $msg = json_decode($amqpMsg->body);

        $x = $msg->x;
        $y = $msg->y;
        $z = $msg->z;

        if($this->isSquare($x+$y) && 
            $this->isSquare($x-$y) && 
            $this->isSquare($x+$z) && 
            $this->isSquare($x-$z) && 
            $this->isSquare($y+$z) && 
            $this->isSquare($y-$z)){
            $result = $x+$y+$z;
            fwrite($this->resultFile, "Solution is - ".$result);
        }
        else{
            $this->publishNextMessages($msg);
        }
    }

    function publishNextMessages($msg){
        $msgx = [
            'x' => $msg->x+1,
            'y' => $msg->y,
            'z' => $msg->z
        ];
        fwrite($this->resultFile,"Publishing - ".json_encode($msgx)."\n");
        $this->queue->publish($msgx);

        if($msg->x - $msg->y > 1){
            $msgy = [
                'x' => $msg->x,
                'y' => $msg->y+1,
                'z' => $msg->z
            ];
            fwrite($this->resultFile,"Publishing - ".json_encode($msgy)."\n");
            $this->queue->publish($msgy);        
        }

        if($msg->y - $msg->z > 1){
            $msgz = [
                'x' => $msg->x,
                'y' => $msg->y,
                'z' => $msg->z+1
            ];
            fwrite($this->resultFile,"Publishing - ".json_encode($msgz)."\n");
            $this->queue->publish($msgz);        
        }
    }

    function isSquare($number){
        if(isset($this->squaresMap["$number"]) && $this->squaresMap["$number"]){
            return true;
        }

        for($i = 1; $i*$i<=$number;$i++){
            if($i*$i==$number){
                $this->squaresMap["$number"] = true;
                return true;
            }
        }
        $this->squaresMap["$number"] = false;
        return false;
    }
}

$solution = new solution142();
$solution->solution();

?>
