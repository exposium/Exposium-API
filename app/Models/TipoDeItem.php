<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeItem extends Model
{
    use HasFactory;

    protected $table = 'tipoDeItem';
    public $timestamps = false;
    protected $primaryKey = "tipoItemID";
}
