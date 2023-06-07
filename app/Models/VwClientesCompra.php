<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VwClientesCompra
 * 
 * @property int $id_cliente
 * @property string $nombre
 * @property string $email
 * @property string $telefono
 * @property Carbon|null $fecha_registro
 *
 * @package App\Models
 */
class VwClientesCompra extends Model
{
	protected $table = 'vw_clientes_compras';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_cliente' => 'int',
		'fecha_registro' => 'datetime'
	];

	protected $fillable = [
		'id_cliente',
		'nombre',
		'email',
		'telefono',
		'fecha_registro'
	];
}
