<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TLugare
 * 
 * @property int $id_lugar
 * @property string|null $nombre_lugar
 *
 * @package App\Models
 */
class TLugare extends Model
{
	protected $table = 't_lugares';
	protected $primaryKey = 'id_lugar';
	public $timestamps = false;

	protected $fillable = [
		'nombre_lugar'
	];
}
