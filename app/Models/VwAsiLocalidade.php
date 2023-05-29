<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwAsiLocalidade
 * 
 * @property int $id_asignacion
 * @property string $titulo_evento
 * @property int $evento
 * @property int $cantidad
 * @property int $vendidos
 * @property string|null $nombre_localidad
 * @property int $localidad
 * @property int $estado
 * @property float $precio
 * @property float|null $descuento
 * @property int $disponibles
 * @property string|null $tipo_localidad
 *
 * @package App\Models
 */
class VwAsiLocalidade extends Model
{
	protected $table = 'vw_asi_localidades';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_asignacion' => 'int',
		'evento' => 'int',
		'cantidad' => 'int',
		'vendidos' => 'int',
		'localidad' => 'int',
		'estado' => 'int',
		'precio' => 'float',
		'descuento' => 'float',
		'disponibles' => 'int'
	];

	protected $fillable = [
		'id_asignacion',
		'titulo_evento',
		'evento',
		'cantidad',
		'vendidos',
		'nombre_localidad',
		'localidad',
		'estado',
		'precio',
		'descuento',
		'disponibles',
		'tipo_localidad'
	];
}
