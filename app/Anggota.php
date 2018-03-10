<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
	protected $table = "anggotas";

    protected $fillable = [
        'no','pin','nama', 'departemen','posisi','totalSimpanan','admin',
    ];

	public $timestamps = false;    
}
