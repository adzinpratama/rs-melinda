<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docter extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'proficiency_id'];

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function proficiency()
    {
        return $this->belongsTo(Proficiency::class);
    }
}
