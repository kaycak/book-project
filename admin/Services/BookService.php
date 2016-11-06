<?php 
namespace Admin\Services;
use App\Models\Book;

class BookService
{
	public function __construct(Book $book){
		$this->book = $book;
	}

	public function getAllBooks() {
		return $this->book->get();
	}
}
