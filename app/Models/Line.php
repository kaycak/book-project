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

    public function book()
    {
        return $this->belongsTo('App\\Models\\Book', 'book_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo('App\\Models\\Page', 'page_id', 'id');
    }

    public function section()
    {
        return $this->belongsTo('App\\Models\\Section', 'section_id', 'id');
    }
}
