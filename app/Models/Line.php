<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $table = 'lines';

    protected $fillable = [
    	'page_id',
    	'book_id',
    	'section_id',
    	'text'
    ];
}
