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
 * @property int|null $tipo_galeria
 * 
 * @property TArtista $t_artista
 * @property TTipoGalerium|null $t_tipo_galerium
 *
 * @package App\Models
 */
class TGaleria extends Model
{
	protected $table = 't_galerias';
	protected $primaryKey = 'id_galeria';
	public $timestamps = false;

	protected $casts = [
		'id_artista' => 'int',
		'tipo_galeria' => 'int'
	];

	protected $fillable = [
		'link_previo',
		'link_download',
		'id_artista',
		'tipo_galeria'
	];

	public function t_artista()
	{
		return $this->belongsTo(TArtista::class, 'id_artista');
	}

	public function t_tipo_galerium()
	{
		return $this->belongsTo(TTipoGalerium::class, 'tipo_galeria');
	}
}
