<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mapel extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['id', 'nama_mapel', 'paket_id', 'model', 'nopol',  'kelompok'];

    public function paket()
    {
        return $this->belongsTo('App\Models\Paket')->withDefault();
    }

    protected $table = 'mapel';
}
