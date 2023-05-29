<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TPrueba
 * 
 * @property string|null $selectseats
 *
 * @package App\Models
 */
class TPrueba extends Model
{
	protected $table = 't_pruebas';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'selectseats'
	];
}
