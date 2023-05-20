<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TGaleria
 * 
 * @property int $id_galeria
 * @property string|null $link_previo
 * @property string|null $link_download
 * @property int $id_artista
 * 
 * @property TArtista $t_artista
 *
 * @package App\Models
 */
class TGaleria extends Model
{
	protected $table = 't_galerias';
	protected $primaryKey = 'id_galeria';
	public $timestamps = false;

	protected $casts = [
		'id_artista' => 'int'
	];

	protected $fillable = [
		'link_previo',
		'link_download',
		'id_artista'
	];

	public function artista()
	{
		return $this->belongsTo(Artista::class, 'id_artista', 'id_artista');
	}
}
