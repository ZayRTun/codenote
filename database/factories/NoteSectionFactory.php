<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NoteSection;
use Faker\Generator as Faker;

$factory->define(NoteSection::class, function (Faker $faker) {
    return [
        'note_id' => 1,
        'body' => '# H1 ## H2  Emphasis, aka italics, with *asterisks* or _underscores_.

        Strong emphasis, aka bold, with **asterisks** or __underscores__.
        
        Combined emphasis with **asterisks and _underscores_**.
        
        Strikethrough uses two tildes. ~~Scratch this.~~',
    ];
});
