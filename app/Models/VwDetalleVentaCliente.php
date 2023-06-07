<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwDetalleVentaCliente
 * 
 * @property int $id_venta
 * @property int $id_boleto
 * @property string $evento
 * @property string|null $localidad
 * @property int|null $mesa
 * @property int|null $asiento
 * @property Carbon $fecha_creacion
 * @property string $estado_boleto
 * @property string|null $tipo_boleto
 *
 * @package App\Models
 */
class VwDetalleVentaCliente extends Model
{
	protected $table = 'vw_detalle_venta_cliente';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_venta' => 'int',
		'id_boleto' => 'int',
		'mesa' => 'int',
		'asiento' => 'int',
		'fecha_creacion' => 'datetime'
	];

	protected $fillable = [
		'id_venta',
		'id_boleto',
		'evento',
		'localidad',
		'mesa',
		'asiento',
		'fecha_creacion',
		'estado_boleto',
		'tipo_boleto'
	];
}
