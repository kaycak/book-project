<?php 
namespace App\Services;
use App\Models\Line;

class LineService
{
	public function __construct(Line $line){
		$this->line = $line;
	}

	public function getBookLinesByBookId($book_id) {
		return $this->line->where('book_id', $book_id)->get();
	}
}

?>