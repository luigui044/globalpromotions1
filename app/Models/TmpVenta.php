<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TmpVentum
 * 
 * @property int $id_venta
 * @property int|null $id_usuario
 * @property int|null $id_evento
 * @property float $precio
 * 
 * @property Collection|TmpDetallesVenta[] $tmp_detalles_ventas
 *
 * @package App\Models
 */
class TmpVenta extends Model
{
	protected $table = 'tmp_venta';
	protected $primaryKey = 'id_venta';
	public $timestamps = false;

	protected $casts = [
		'id_usuario' => 'int',
		'id_evento' => 'int',
		'precio' => 'float'
	];

	protected $fillable = [
		'id_usuario',
		'id_evento',
		'precio'
	];

	public function tmp_detalles_ventas()
	{
		return $this->hasMany(TmpDetallesVenta::class, 'id_venta');
	}
}
