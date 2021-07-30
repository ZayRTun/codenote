<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

    public function sections()
    {
        return $this->hasMany(NoteSection::class);
    }
}
