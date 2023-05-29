<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CTipoBoleto
 * 
 * @property int $id_tipo_boleto
 * @property string|null $tipo_boleto
 * 
 * @property Collection|TBoleto[] $t_boletos
 *
 * @package App\Models
 */
class CTipoBoleto extends Model
{
	protected $table = 'c_tipo_boleto';
	protected $primaryKey = 'id_tipo_boleto';
	public $timestamps = false;

	protected $fillable = [
		'tipo_boleto'
	];

	public function t_boletos()
	{
		return $this->hasMany(TBoleto::class, 'tipo_boleto');
	}
}
