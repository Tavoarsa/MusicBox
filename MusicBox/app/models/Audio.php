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
	


}