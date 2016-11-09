<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
    	'name',
    	'logo'
    ];

    public function pages()
    {
    	return $this->hasMany('App\\Models\\Page', 'book_id', 'id');
    }

    public function sections()
    {
    	return $this->hasMany('App\\Models\\Section', 'book_id', 'id');
    }

    public function lines()
    {
    	return $this->hasMany('App\\Models\\Line', 'book_id', 'id');
    }
}
