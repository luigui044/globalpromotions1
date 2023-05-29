<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TTipoGalerium
 * 
 * @property int $id_tipo
 * @property string|null $desc_tipo
 * 
 * @property Collection|TGaleria[] $t_galerias
 *
 * @package App\Models
 */
class TTipoGalerium extends Model
{
	protected $table = 't_tipo_galeria';
	protected $primaryKey = 'id_tipo';
	public $timestamps = false;

	protected $fillable = [
		'desc_tipo'
	];

	public function t_galerias()
	{
		return $this->hasMany(TGaleria::class, 'tipo_galeria');
	}
}
