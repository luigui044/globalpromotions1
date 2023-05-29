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
 * @property int $id
 * @property int $id_localidad
 * @property int $id_evento
 * @property int $fecha_stamp
 * @property string|null $codigo_qr
 * @property int|null $mesa
 * @property int|null $asiento
 * @property int $estado_boleto
 * @property int $tipo_boleto
 * @property Carbon $fecha_creacion
 * 
 * @property CEstadosBoleto $c_estados_boleto
 * @property CTipoBoleto $c_tipo_boleto
 * @property TDetaVenta $t_deta_venta
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
		'mesa' => 'int',
		'asiento' => 'int',
		'estado_boleto' => 'int',
		'tipo_boleto' => 'int',
		'fecha_creacion' => 'datetime'
	];

	protected $fillable = [
		'codigo_qr',
		'mesa',
		'asiento',
		'estado_boleto',
		'tipo_boleto',
		'fecha_creacion'
	];

	public function c_estados_boleto()
	{
		return $this->belongsTo(CEstadosBoleto::class, 'estado_boleto');
	}

	public function c_tipo_boleto()
	{
		return $this->belongsTo(CTipoBoleto::class, 'tipo_boleto');
	}

	public function t_deta_venta()
	{
		return $this->hasOne(TDetaVenta::class, 'id_boleto');
	}
}
