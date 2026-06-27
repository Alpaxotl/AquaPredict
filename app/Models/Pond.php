<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pond extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
    ];

    public function waterLogs()
    {
        return $this->hasMany(WaterLog::class);
    }
}
