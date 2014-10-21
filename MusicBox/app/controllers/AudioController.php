<?php

class AudioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
		if (Request::ajax())
		{
    		$audios = Audio::all();
    		return Response::Json($audios);
		}
		$this->layout->titulo = 'Audios';
		$this->layout->nest(
			'content',
			'files.index'
		);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->titulo = 'Subir Audio';
		$this->layout->nest(
			'content',
			'files.create',
			array()
		);
	}
	


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
		{
			$name = Input::get('name');
        	$route = '/home/Tavo/Documents/Progra/III Cuatrimestre/Projects/ProyectoI/Server/';
			$file = Input::file('track'); 		
			$part= Input::get('parts');
			$minutes= Input::get('minutes');
			$format = Input::get('format');
			$filename = $file->getClientOriginalName();
			$formato=$file->getClientOriginalExtension();
			if($part || $minutes == null){
				$part=0;
						
					}

			if($formato=='mp3'||$formato=='mp4'||$formato=='wma'||$formato=='Aac')
				{

						$upload_success = Input::file('track')->move($route, $filename); 
						$name = Input::get('name');     	
						$music = new Audio;
						$music->name_audio = $name;
						$music->url_audio = $route;
						$music->parts= $part;
						$music->time_per_chunck= $minutes;
						$music->save();
						
				}else
					{
						echo "upported Format" ;
				}

				$audios = Audio::lastRown();
				return Response::Json($audios);



				$amqp = require('amqp');
				$helper = require('./amqp-hacks');
 
				$conexion = amqp.createConnection({host: 'localhost'});
 
				conexion.on('ready', function(){
 
    			$mensaje = 'Hola CODEHERO ' + new Date();
 
    			conexion.publish('sencilla', mensaje);
 
    		helper.safeEndConnection(conexion);
});



		}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
