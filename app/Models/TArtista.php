<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TArtista
 * 
 * @property int $id_artista
 * @property string|null $nombre
 * @property string|null $link_imagen
 * @property string|null $link_imagen_post
 * @property string|null $link_de_compra
 * @property string|null $fecha_presentacion
 * @property string|null $hora_presentacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TEvento[] $t_eventos
 * @property Collection|TGaleria[] $t_galerias
 *
 * @package App\Models
 */
class TArtista extends Model
{
	protected $table = 't_artistas';
	protected $primaryKey = 'id_artista';

	protected $fillable = [
		'nombre',
		'link_imagen',
		'link_imagen_post',
		'link_de_compra',
		'fecha_presentacion',
		'hora_presentacion'
	];

	public function t_eventos()
	{
		return $this->hasMany(TEvento::class, 'id_artista');
	}

	public function t_galerias()
	{
		return $this->hasMany(TGaleria::class, 'id_artista');
	}
}
