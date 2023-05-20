<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TEvento
 * 
 * @property int $id_evento
 * @property string $titulo_evento
 * @property string $copy_evento
 * @property int|null $id_artista
 * @property string|null $fechas
 * @property string|null $hora
 * @property string|null $localidades
 * @property string|null $ruta_compra
 * @property string|null $ruta_galeria
 * @property string|null $image_card
 * @property string|null $image_banner
 * @property int|null $estado_evento
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * 
 * @property TArtista|null $t_artista
 * @property Collection|TEventosClic[] $t_eventos_clics
 *
 * @package App\Models
 */
class TEvento extends Model
{
	protected $table = 't_eventos';
	protected $primaryKey = 'id_evento';

	protected $casts = [
		'id_artista' => 'int',
		'estado_evento' => 'int'
	];

	protected $fillable = [
		'titulo_evento',
		'copy_evento',
		'id_artista',
		'fechas',
		'hora',
		'localidades',
		'ruta_compra',
		'ruta_galeria',
		'image_card',
		'image_banner',
		'estado_evento'
	];

	public function t_artista()
	{
		return $this->belongsTo(TArtista::class, 'id_artista');
	}

	public function t_eventos_clics()
	{
		return $this->hasMany(TEventosClic::class, 'id_evento');
	}
}
