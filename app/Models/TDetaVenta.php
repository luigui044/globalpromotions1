<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TDetaVenta
 * 
 * @property int $id_venta
 * @property int $id_boleto
 * @property int $id_localidad
 * @property int $id_evento
 * @property int $fecha_stamp
 * @property int|null $mesa
 * @property int|null $asiento
 * @property float $total
 * 
 * @property TBoleto $t_boleto
 * @property TVenta $t_venta
 *
 * @package App\Models
 */
class TDetaVenta extends Model
{
	protected $table = 't_deta_ventas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_venta' => 'int',
		'id_boleto' => 'int',
		'id_localidad' => 'int',
		'id_evento' => 'int',
		'fecha_stamp' => 'int',
		'mesa' => 'int',
		'asiento' => 'int',
		'total' => 'float'
	];

	protected $fillable = [
		'id_venta',
		'id_boleto',
		'id_localidad',
		'id_evento',
		'fecha_stamp',
		'mesa',
		'asiento',
		'total'
	];

	public function t_boleto()
	{
		return $this->belongsTo(TBoleto::class, 'id_boleto')
					->where('t_boletos.id', '=', 't_deta_ventas.id_boleto')
					->where('t_boletos.id_localidad', '=', 't_deta_ventas.id_localidad')
					->where('t_boletos.id_evento', '=', 't_deta_ventas.id_evento')
					->where('t_boletos.fecha_stamp', '=', 't_deta_ventas.fecha_stamp');
	}

	public function t_venta()
	{
		return $this->belongsTo(TVenta::class, 'id_venta');
	}
}
