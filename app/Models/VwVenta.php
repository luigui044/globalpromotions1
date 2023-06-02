<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwVenta
 * 
 * @property int $id
 * @property int $id_cliente
 * @property string $nombre
 * @property int $id_evento
 * @property string $titulo_evento
 * @property string|null $fechas
 * @property string|null $hora
 * @property string|null $lugar
 *
 * @package App\Models
 */
class VwVenta extends Model
{
	protected $table = 'vw_ventas';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id' => 'int',
		'id_cliente' => 'int',
		'id_evento' => 'int'
	];

	protected $fillable = [
		'id',
		'id_cliente',
		'nombre',
		'id_evento',
		'titulo_evento',
		'fechas',
		'hora',
		'lugar'
	];
}
