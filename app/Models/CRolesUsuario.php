<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CRolesUsuario
 * 
 * @property int $id
 * @property string|null $desc_rol
 * 
 * @property Collection|User[] $users
 *
 * @package App\Models
 */
class CRolesUsuario extends Model
{
	protected $table = 'c_roles_usuarios';
	public $timestamps = false;

	protected $fillable = [
		'desc_rol'
	];

	public function users()
	{
		return $this->hasMany(User::class, 'rol', 'id');
	}
}
