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
		'cantidad' => 'int',
		'vendidos' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'evento',
		'localidad',
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
