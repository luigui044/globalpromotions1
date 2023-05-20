<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tracking extends Model
{
	protected $table = 't_eventos_clics';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'ip',
		'clic',
		'fecha_hora',
		'id_evento'
	];

}
