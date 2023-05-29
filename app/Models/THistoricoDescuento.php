<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class THistoricoDescuento
 * 
 * @property int $id
 * @property int $evento
 * @property int $asig_local
 * @property float $precio
 * @property float $descuento
 * @property Carbon $fecha_inicio
 * @property Carbon $fecha_final
 * @property float $precio_descuento
 * @property int $fecha
 *
 * @package App\Models
 */
class THistoricoDescuento extends Model
{
	protected $table = 't_historico_descuentos';
	public $timestamps = false;

	protected $casts = [
		'evento' => 'int',
		'asig_local' => 'int',
		'precio' => 'float',
		'descuento' => 'float',
		'fecha_inicio' => 'datetime',
		'fecha_final' => 'datetime',
		'precio_descuento' => 'float',
		'fecha' => 'int'
	];

	protected $fillable = [
		'evento',
		'asig_local',
		'precio',
		'descuento',
		'fecha_inicio',
		'fecha_final',
		'precio_descuento',
		'fecha'
	];
}
