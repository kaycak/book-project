<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $fillable = [
        'book_id',
        'page_number',
        'image_path'
    ];

    public function sections()
    {
    	return $this->hasMany('App\\Models\\Section', 'page_id', 'id');
    }

    public function lines()
    {
    	return $this->hasMany('App\\Models\\Line', 'page_id', 'id');
    }
}
