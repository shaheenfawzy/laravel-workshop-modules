<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;
}