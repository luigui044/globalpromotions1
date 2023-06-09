<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwVentasPorLocalidadYFecha
 * 
 * @property int $id_evento
 * @property int $id_localidad
 * @property string|null $localidad
 * @property int $cantidad
 * @property Carbon $fecha_creacion
 * @property float $precio
 * @property float $total
 *
 * @package App\Models
 */
class VwVentasPorLocalidadYFecha extends Model
{
	protected $table = 'vw_ventas_por_localidad_y_fecha';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_evento' => 'int',
		'id_localidad' => 'int',
		'cantidad' => 'int',
		'fecha_creacion' => 'datetime',
		'precio' => 'float',
		'total' => 'float'
	];

	protected $fillable = [
		'id_evento',
		'id_localidad',
		'localidad',
		'cantidad',
		'fecha_creacion',
		'precio',
		'total'
	];
}
