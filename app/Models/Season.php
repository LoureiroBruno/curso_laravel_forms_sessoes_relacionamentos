<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Season extends Model
{
    use HasFactory;

    /**
     * series function - serie
     *
     * @return void
     */
    public function series()
    {
        /** A temporada percentecem  a uma serie */
        return $this->BelongsTo(Serie::class);
    }

    /**
     * episodes function - episodios
     *
     * @return void
     */
    public function episodes()
    {
        /** A temporada possue muitos epsodios  */
        return $this->hasMany(related: Episode::class);
    }
}
