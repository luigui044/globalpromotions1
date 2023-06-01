<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TPrerreserva
 * 
 * @property int $id
 * @property int $id_usuario
 * @property int $id_localidad
 * @property int $id_evento
 * @property int $mesa
 * @property int $asiento
 *
 * @package App\Models
 */
class TPrerreserva extends Model
{
	protected $table = 't_prerreservas';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_localidad' => 'int',
		'id_evento' => 'int',
		'mesa' => 'int',
		'asiento' => 'int'
	];

	protected $fillable = [
		'id_usuario',
		'id_localidad',
		'id_evento',
		'mesa',
		'asiento'
	];
}
