<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwVentasPorLocalidad
 * 
 * @property int $id_evento
 * @property int $id_localidad
 * @property string|null $localidad
 * @property int $cantidad
 * @property float $precio
 * @property float $total
 *
 * @package App\Models
 */
class VwVentasPorLocalidad extends Model
{
	protected $table = 'vw_ventas_por_localidad';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_evento' => 'int',
		'id_localidad' => 'int',
		'cantidad' => 'int',
		'precio' => 'float',
		'total' => 'float'
	];

	protected $fillable = [
		'id_evento',
		'id_localidad',
		'localidad',
		'cantidad',
		'precio',
		'total'
	];
}
