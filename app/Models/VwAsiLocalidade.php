<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwAsiLocalidade
 * 
 * @property string $titulo_evento
 * @property int $evento
 * @property int $cantidad
 * @property string|null $nombre_localidad
 * @property int $localidad
 * @property int $estado
 *
 * @package App\Models
 */
class VwAsiLocalidade extends Model
{
	protected $table = 'vw_asi_localidades';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'evento' => 'int',
		'cantidad' => 'int',
		'localidad' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'titulo_evento',
		'evento',
		'cantidad',
		'nombre_localidad',
		'localidad',
		'estado'
	];
}
