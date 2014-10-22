<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPConnection;

$connection = new AMQPConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, true, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

	$callback = function($msg){
	//$obj =json_encode($msg->body);	
 	echo " [x] Received ", $msg->body, "\n";

    //dividir el archivo

  	/*$path = "/home/Tavo/2.mp3	";	//esta es la cancion a escoger
	//// es para saber el tiempo que dura la cancion en segungos
	$time = exec("ffmpeg -i " . escapeshellarg($path) . " 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
	if (isset($time)) {
			list($hms, $milli) = explode('.', $time);
	list($hours, $minutes, $seconds) = explode(':', $hms);
	$total_seconds = ($hours * 3600) + ($minutes * 60) + $seconds;
	//// imprimo para ver los valore No es necesario
	echo "\n";
	echo $time."\n";
	echo $hms."\n";
	echo $total_seconds."\n";
	echo ($argv[1])."\n";
	//division para sacar el tiempo de cada una de las partes a dividir
	$result_division = ($total_seconds/$argv[1]);
		//para conocer el nombre del archivo y la extencion
	$file = substr($path, 0, -4);
	$extesion = substr($path, -4, 4); 

	$o=0;
	for ($i=0; $i < $argv[1]; $i++) { 
		
		if ($i==0){
			//-t para cortar el nuevo archivo del tiempo dado en este caso por el resultado de la divicion
			exec("ffmpeg -t ". $result_division ." -i ".$file.$extesion." ".$file.$i.$extesion);
			//-ss le quita el tiempo de la cancion original para crear un archivo con el tiempo restante
			exec("ffmpeg -ss ". $result_division ." -i ".$file.$extesion." ".$file."new".$i.$extesion);
		}else{
			exec("ffmpeg -t ". $result_division ." -i ".$file."new".$o.$extesion." ".$file.$i.$extesion);
			exec("ffmpeg -ss ". $result_division ." -i ".$file."new".$o.$extesion." ".$file."new".$i.$extesion);
			// borra el archivo creado de mas para manipular los tiempos
			unlink($file."new".$o.$extesion);
			unlink($file."new".$o.$extesion);
			$o=$i;	
		}
		
	}
	unlink($file."new".$o.$extes*/


  sleep(substr_count($msg->body, '.'));
  echo " [x] Done", "\n";
  $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('hello', '', false, false, false, false, $callback);

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();

?> 
