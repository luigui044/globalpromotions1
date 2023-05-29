<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CatTipoPago
 * 
 * @property int|null $id_tipo_pago
 * @property string|null $des_tipo_pago
 *
 * @package App\Models
 */
class CatTipoPago extends Model
{
	protected $table = 'cat_tipo_pago';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_tipo_pago' => 'int'
	];

	protected $fillable = [
		'id_tipo_pago',
		'des_tipo_pago'
	];
}
