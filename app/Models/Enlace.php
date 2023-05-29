<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Enlace
 * 
 * @property int $enlaces_id
 * @property string|null $link
 * @property string|null $link_descarga
 * @property int $id
 *
 * @package App\Models
 */
class Enlace extends Model
{
	protected $table = 'enlaces';
	protected $primaryKey = 'enlaces_id';
	public $timestamps = false;

	protected $casts = [
		'id' => 'int'
	];

	protected $fillable = [
		'link',
		'link_descarga',
		'id'
	];
}
