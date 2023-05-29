<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CEstadoUsuario
 * 
 * @property int $id
 * @property string|null $desc_estado
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class CEstadoUsuario extends Model
{
	protected $table = 'c_estado_usuarios';
	public $timestamps = false;

	protected $fillable = [
		'desc_estado'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'estado');
	}
}
