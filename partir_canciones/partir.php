<?php
	$path = 'Test1.mp3';	//esta es la cancion a escoger
	//// es para saber el tiempo que dura la cancion en segungos
	$time = exec("ffmpeg -i " . escapeshellarg($path) . " 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");
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
	unlink($file."new".$o.$extesion);

/**esto se corre en consola de la siguiente manera
php partirMin.php 4
4= cantiad de partes en las que deseo partir el archivo*/
