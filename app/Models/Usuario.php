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
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'id_usuario';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
		'email',
		'telefono',
		'ip'
	];

}
