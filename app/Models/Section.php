<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';

    protected $fillable = [
    	'page_id',
    	'book_id',
    	'name',
    	'number'
    ];

    public function lines()
    {
    	return $this->hasMany('App\\Models\\Line', 'section_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo('App\\Models\\Page', 'page_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo('App\\Models\\Book', 'book_id', 'id');
    }
}
