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

	public function createBook($params) {
		$file_name = '';
		if(isset($params['logo'])) {
			$file = $params['logo'];
			$file_name = $this->getFileName($file);
			$file->move(public_path().'/images/book_images', $file_name);
		} else {
			$file_name = '';
		}
		$inputs = $this->getBookCreateParams($params, $file_name);
		
		return $this->book->create($inputs);
		
	}

	public function getFileName($file) {
		$file_name = str_random(32). '.' .$file->getClientOriginalExtension();
		return $file_name;
	}

	public function getBookCreateParams($params, $file_name) {
		$inputs = [];
		$inputs['logo'] = $file_name;
		$inputs['name'] = $params['name'];
		return $inputs;
	}

	public function getBookById($id) {
		return $this->book->find($id);
	}

	public function updateBook($id, $params) {
		$book = $this->getBookById($id);
		if(isset($params['logo'])) {
			$file = $params['logo'];
			$file_name = $this->getFileName($file);
			$params['logo'] = $file_name;
			$file->move(public_path().'/images/book_images', $file_name);
		}
		$book->update($params);
		if($book) {
			return $book;
		}
		return null;	
	}

	public function deletBookById($id) {
		$book = $this->getBookById($id);
		return $book->delete();
	}


	public function uploadFileFromUrl($url) {
		$name = basename($url);
		list($txt, $ext) = explode(".", $name);
		$name = str_random(32);
		$name = $name.".".$ext;
		//check if the files are only image
		if($ext == "jpg" || $ext == "png"){

			$upload = file_put_contents(public_path()."/images/book_images/".$name, file_get_contents($url));
			if($upload) {
				return $name;
			} else {
				return '';
			}
		}
		return '';
	}
}
