<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    protected $table = 'Tempat';

    public $filable = [
    					'kategori_id',
    					'nama_tempat',
    					'alamat',
    					'keterangan',
    					'latitude',
    					'longitude'
    				];
}
