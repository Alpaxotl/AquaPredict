<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'pond_id',
        'ph',
        'temperature',
        'dissolved_oxygen',
        'turbidity',
        'bod',
        'co2',
        'alkalinity',
        'hardness',
        'calcium',
        'ammonia',
        'nitrite',
        'phosphorus',
        'h2s',
        'plankton',
        'status',
        'recommendation',
        'recorded_by',
    ];

    public function pond()
    {
        return $this->belongsTo(Pond::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}