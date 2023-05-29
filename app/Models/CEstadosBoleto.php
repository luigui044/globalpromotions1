<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CEstadosBoleto
 * 
 * @property int $id_estado_boleto
 * @property string $estado_boleto
 * 
 * @property Collection|TBoleto[] $t_boletos
 *
 * @package App\Models
 */
class CEstadosBoleto extends Model
{
	protected $table = 'c_estados_boleto';
	protected $primaryKey = 'id_estado_boleto';
	public $timestamps = false;

	protected $fillable = [
		'estado_boleto'
	];

	public function t_boletos()
	{
		return $this->hasMany(TBoleto::class, 'estado_boleto');
	}
}
