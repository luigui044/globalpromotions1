<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CTipoLocalidad
 * 
 * @property int $id_tipo_localidad
 * @property string|null $des_tipo
 * 
 * @property Collection|TLocalidade[] $t_localidades
 *
 * @package App\Models
 */
class CTipoLocalidad extends Model
{
	protected $table = 'c_tipo_localidad';
	protected $primaryKey = 'id_tipo_localidad';
	public $timestamps = false;

	protected $fillable = [
		'des_tipo'
	];

	public function t_localidades()
	{
		return $this->hasMany(TLocalidade::class, 'tipo_localidad');
	}
}
