<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exposicao extends Model
{
    use HasFactory;

    protected $table = 'exposicao';
    public $timestamps = false;
    //protected $primaryKey = "exposicaoID";
}
