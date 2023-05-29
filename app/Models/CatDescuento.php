<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CatDescuento
 * 
 * @property int|null $id_descuento
 * @property string|null $descripcion
 *
 * @package App\Models
 */
class CatDescuento extends Model
{
	protected $table = 'cat_descuentos';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_descuento' => 'int'
	];

	protected $fillable = [
		'id_descuento',
		'descripcion'
	];
}
