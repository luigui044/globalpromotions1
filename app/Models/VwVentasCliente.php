<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwVentasCliente
 * 
 * @property int $id_venta
 * @property int $id_cliente
 * @property int $id_evento
 * @property string $evento
 * @property float|null $total
 * @property Carbon $fecha
 *
 * @package App\Models
 */
class VwVentasCliente extends Model
{
	protected $table = 'vw_ventas_clientes';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_venta' => 'int',
		'id_cliente' => 'int',
		'id_evento' => 'int',
		'total' => 'float',
		'fecha' => 'datetime'
	];

	protected $fillable = [
		'id_venta',
		'id_cliente',
		'id_evento',
		'evento',
		'total',
		'fecha'
	];
}
