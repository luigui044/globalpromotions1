<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TBoleto
 * 
 * @property int $id_boleto
 * @property int $id_localidad
 * @property int $id_evento
 * @property int $fecha_stamp
 * @property int|null $estado_boleto
 * @property Carbon|null $fecha_creacion
 *
 * @package App\Models
 */
class TBoleto extends Model
{
	protected $table = 't_boletos';
	public $timestamps = false;

	protected $casts = [
		'id_localidad' => 'int',
		'id_evento' => 'int',
		'fecha_stamp' => 'int',
		'estado_boleto' => 'int'
	];

	protected $dates = [
		'fecha_creacion'
	];

	protected $fillable = [
		'estado_boleto',
		'fecha_creacion'
	];
}
