<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Artista extends Model
{
	protected $table = 't_artistas';
	protected $primaryKey = 'id_artista';
	public $timestamps = true;

	protected $casts = [
		'id_artista' => 'int'
	];

	protected $fillable = [
		'nombre',
		'link_imagen',
		'link_imagen_post',
		'link_de_compra',
		'fecha_presentacion',
		'hora_presentacion',
	];

	public function galeria()
	{
		return $this->hasMany(TGaleria::class, 'id_artista', 'id_artista');
	}
}
