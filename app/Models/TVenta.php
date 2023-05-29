<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TVenta
 * 
 * @property int $id_venta
 * @property string|null $nombre_cliente
 * @property string|null $telefono_cliente
 * @property string|null $correo_cliente
 * @property Carbon|null $fecha
 * @property int|null $id_evento
 * @property int|null $tipo_venta
 * @property float|null $subtotal
 * @property float|null $iva
 * @property float|null $total
 * 
 * @property TDetaVenta $t_deta_venta
 *
 * @package App\Models
 */
class TVenta extends Model
{
	protected $table = 't_ventas';
	protected $primaryKey = 'id_venta';
	public $timestamps = false;

	protected $casts = [
		'fecha' => 'datetime',
		'id_evento' => 'int',
		'tipo_venta' => 'int',
		'subtotal' => 'float',
		'iva' => 'float',
		'total' => 'float'
	];

	protected $fillable = [
		'nombre_cliente',
		'telefono_cliente',
		'correo_cliente',
		'fecha',
		'id_evento',
		'tipo_venta',
		'subtotal',
		'iva',
		'total'
	];

	public function t_deta_venta()
	{
		return $this->hasOne(TDetaVenta::class, 'id_venta');
	}
}
