<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TEventosClic
 * 
 * @property int $id
 * @property string|null $ip
 * @property int|null $clic
 * @property Carbon $fecha_hora
 * @property Carbon $fecha
 * @property int $id_evento
 * 
 * @property TEvento $t_evento
 *
 * @package App\Models
 */
class TEventosClic extends Model
{
	protected $table = 't_eventos_clics';
	public $timestamps = false;

	protected $casts = [
		'clic' => 'int',
		'fecha_hora' => 'datetime',
		'fecha' => 'datetime',
		'id_evento' => 'int'
	];

	protected $fillable = [
		'ip',
		'clic',
		'fecha_hora',
		'fecha',
		'id_evento'
	];

	public function t_evento()
	{
		return $this->belongsTo(TEvento::class, 'id_evento');
	}
}
