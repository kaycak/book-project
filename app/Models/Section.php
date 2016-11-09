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
}
