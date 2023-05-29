<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $segundo_apellido
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $telefono
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $rol
 * @property int|null $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CEstadoUsuario|null $c_estado_usuario
 * @property CRolesUsuario|null $c_roles_usuario
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'rol' => 'int',
		'estado' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'first_name',
		'middle_name',
		'last_name',
		'segundo_apellido',
		'email',
		'email_verified_at',
		'telefono',
		'password',
		'remember_token',
		'rol',
		'estado'
	];

	public function c_estado_usuario()
	{
		return $this->belongsTo(CEstadoUsuario::class, 'estado');
	}

	public function c_roles_usuario()
	{
		return $this->belongsTo(CRolesUsuario::class, 'rol');
	}
}
