<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TGil
 * 
 * @property int $t_gil_id
 * @property string|null $link_previo
 * @property string|null $link_download
 * @property int $id_artista
 * @property int $tipo_galeria
 *
 * @package App\Models
 */
class TGil extends Model
{
	protected $table = 't_gil';
	protected $primaryKey = 't_gil_id';
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
}
