<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TLocalidade
 * 
 * @property int $id_localidad
 * @property string|null $nombre_localidad
 * @property string|null $desc_localidad
 * @property int|null $id_lugar
 * 
 * @property Collection|TAsigLocalidade[] $t_asig_localidades
 *
 * @package App\Models
 */
class TLocalidade extends Model
{
	protected $table = 't_localidades';
	protected $primaryKey = 'id_localidad';
	public $timestamps = false;

	protected $casts = [
		'id_lugar' => 'int'
	];

	protected $fillable = [
		'nombre_localidad',
		'desc_localidad',
		'id_lugar'
	];

	public function t_asig_localidades()
	{
		return $this->hasMany(TAsigLocalidade::class, 'localidad');
	}
}
