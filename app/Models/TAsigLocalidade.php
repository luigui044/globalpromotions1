<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TAsigLocalidade
 * 
 * @property int $id_asignacion
 * @property int $evento
 * @property int $localidad
 * @property float $precio
 * @property float|null $descuento
 * @property Carbon|null $inicio_desc
 * @property Carbon|null $fin_desc
 * @property int $cantidad
 * @property int $vendidos
 * @property int $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property TEvento $t_evento
 * @property TLocalidade $t_localidade
 *
 * @package App\Models
 */
class TAsigLocalidade extends Model
{
	protected $table = 't_asig_localidades';
	protected $primaryKey = 'id_asignacion';

	protected $casts = [
		'evento' => 'int',
		'localidad' => 'int',
		'precio' => 'float',
		'descuento' => 'float',
		'inicio_desc' => 'datetime',
		'fin_desc' => 'datetime',
		'cantidad' => 'int',
		'vendidos' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'evento',
		'localidad',
		'precio',
		'descuento',
		'inicio_desc',
		'fin_desc',
		'cantidad',
		'vendidos',
		'estado'
	];

	public function t_evento()
	{
		return $this->belongsTo(TEvento::class, 'evento');
	}

	public function t_localidade()
	{
		return $this->belongsTo(TLocalidade::class, 'localidad');
	}
}
