<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwDatosBoleto
 * 
 * @property int $id_venta
 * @property int $localidad
 * @property float $precio
 * @property string|null $nombre_localidad
 * @property string|null $codigo_qr
 * @property int $id_localidad
 * @property int|null $mesa
 * @property int|null $asiento
 * @property int $estado_boleto
 * @property int $tipo_boleto
 *
 * @package App\Models
 */
class VwDatosBoleto extends Model
{
	protected $table = 'vw_datos_boletos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_venta' => 'int',
		'localidad' => 'int',
		'precio' => 'float',
		'id_localidad' => 'int',
		'mesa' => 'int',
		'asiento' => 'int',
		'estado_boleto' => 'int',
		'tipo_boleto' => 'int'
	];

	protected $fillable = [
		'id_venta',
		'localidad',
		'precio',
		'nombre_localidad',
		'codigo_qr',
		'id_localidad',
		'mesa',
		'asiento',
		'estado_boleto',
		'tipo_boleto'
	];
}
