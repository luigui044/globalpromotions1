<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TmpDetallesVenta
 * 
 * @property int $id_detalle
 * @property int $id_venta
 * @property int $mesa
 * @property int $asiento
 * @property int $id_evento
 * 
 * @property TmpVentum $tmp_ventum
 *
 * @package App\Models
 */
class TmpDetallesVenta extends Model
{
	protected $table = 'tmp_detalles_ventas';
	protected $primaryKey = 'id_detalle';
	public $timestamps = false;

	protected $casts = [
		'id_venta' => 'int',
		'mesa' => 'int',
		'asiento' => 'int',
		'id_evento' => 'int'
	];

	protected $fillable = [
		'id_venta',
		'mesa',
		'asiento',
		'id_evento'
	];

	public function tmp_ventum()
	{
		return $this->belongsTo(TmpVentum::class, 'id_venta');
	}
}
