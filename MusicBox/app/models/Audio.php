<?php

class Audio extends Eloquent
{
	protected $table 		= 'file';
	protected $fillable		= array('name_audio','url_audio','parts','time_per_chunck');
	protected $guarded		= array('id');
	public 	  $timestamps 	= false;

	public static function lastRown()
	{
		$sql = 'select * 
				FROM file
				ORDER BY id DESC
				LIMIT 1';
				return DB::select($sql);
	}



class  New_task {

	require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();


$channel->queue_declare('task_queue', false, true, false, false);

$data = implode(' ', array_slice($argv, 1));
if(empty($data)) $data = "Araya!";
$msg = new AMQPMessage($data,
                        array('delivery_mode' => 2) # make message persistent
                      );

$channel->basic_publish($msg, '', 'task_queue');

echo " [x] Sent ", $data, "\n";

$channel->close();
$connection->close();





}




	


}