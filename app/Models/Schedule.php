<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['time', 'day', 'docter_id'];

    public function docter()
    {
        return $this->belongsTo(Docter::class, 'docter_id');
    }
}
