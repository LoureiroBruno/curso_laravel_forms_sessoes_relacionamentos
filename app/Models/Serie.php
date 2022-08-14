<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nome',
    ];

    /**
     * seasons function - temporadas
     *
     * @return void
     */
    public function seasons()
    {
        /** Uma seria possue muitas temporadas */
        return $this->hasMany(related: Season::class, foreignKey:'series_id');
    }
}
