<?php

require_once 'vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Exchange\AMQPExchangeType;

class rabbitmq
{
    private $connection = null;
    private $channel = null;
    private $queueName = "default_queue";

    public function __construct($queueName){
        $this->queueName = $queueName;
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($this->queueName, false, true, false, false);
        $this->channel->exchange_declare($this->queueName,"direct");
        $this->channel->queue_bind($this->queueName,$this->queueName,$this->queueName);
    }

    private function close(){
        $this->channel->close();
        $this->connection->close();
    }

    public function publish($message){
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, $this->queueName, $this->queueName);
    } 

    /**
     * Listens for incoming messages
     */
    public function listen($callback)
    {        
        $this->channel->basic_consume(
            $this->queueName,                    #queue 
            '',                             #consumer tag - Identifier for the consumer, valid within the current channel. just string
            false,                          #no local - TRUE: the server will not send messages to the connection that published them
            true,                           #no ack - send a proper acknowledgment from the worker, once we're done with a task
            false,                          #exclusive - queues may only be accessed by the current connection
            false,                          #no wait - TRUE: the server will not respond to the method. The client should not wait for a reply method
            $callback    #callback - method that will receive the message
            );
            
        while($this->channel->is_consuming()) {
            $this->channel->wait();
        }
        
        $this->close();
    }

    public function stop(){
        $this->channel->basic_cancel('', false, false);
    }
}
?>