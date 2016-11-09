<?php 
namespace Admin\Services;
use App\Models\Book;
use App\Models\Page;
use App\Models\Line;
use App\Models\Section;
use DB;
use App\Exceptions\Custom\FailedTransactionException;

class BookService
{
	public function __construct(Book $book, Page $page, Line $line, Section $section){
		$this->book = $book;
        $this->page = $page;
        $this->line = $line;
        $this->section = $section;
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
			$file_name = 'default.jpg';
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

	public function createPage($book_id, $params) {
		$page_params = $this->getCreatePageParams($book_id, $params);

        DB::beginTransaction();
        try {
            $page = $this->page->create($page_params);
            $section_params = $this->getCreateSectionParams($book_id, $params, $page);
            $section = $this->section->insert($section_params);
            $line_params = $this->getCreateLineParams($book_id, $params, $page->id);
            $line = $this->line->insert($line_params);
            DB::commit();
            return $line;
        }
        catch(\Exception $e)
        {
            DB::rollback();
            throw new FailedTransactionException('line create failed', -1);
        }
		return null;
	}

    public function getCreatePageParams($book_id, $params) {
        $page = $this->page->where('book_id', $book_id)->orderBy('id', 'DESC')->first();
        if(null != $page) {
            $page_number = $page->number;
        } else{
            $page_number = 0;
        }
        $file_name = '';
        $page_params = [];
        if(isset($params['img'])) {
            $file = $params['img'];
            $file_name = $this->getFileName($file);
            //$file->move(public_path().'/images/book_images', $file_name);
        } else {
            $file_name = 'default.jpg';
        }
        $page_params['book_id'] = $book_id;
        $page_params['image_path'] = $file_name;
        $page_params['page_number'] = $page_number + 1;
        return $page_params;

    }

    public function getCreateSectionParams($book_id, $params, $page) {
        $section = [];
        for($i = 1; $i <= count($params); $i++) {
            if (isset($params['section_' . $i])) {
                $section[$i]['page_id'] = $page->id;
                $section[$i]['book_id'] = $book_id;
                $section[$i]['name'] = $params['section_' . $i];
                $section[$i]['number'] = $i;
            }
        }
        return $section;
    }

	public function getCreateLineParams($book_id, $params, $page_id) {
        $section_count = 1;
        $line_count = 1;
        $inputs = [];
        $final_array = [];
        for($i = 1; $i <= count($params); $i++) {
            if (isset($params['section_' . $i])) {
                $section_count++;
                for ($j = 1; $j < count($params); $j++) {
                    if (isset($params['line_' . $i . '_' . $j])) {
                        $line_count++;
                    }
                }
            }
        }
       // dd($section_count, $line_count);
        for($i = 1; $i < $section_count; $i++) {
            if(isset($params['section_'.$i])) {
                for($j = 1; $j < $line_count; $j++) {
                    if(isset($params['line_'.$i.'_'.$j])) {
                        $inputs[$i][$j]['section_id'] = $i;
                        $inputs[$i][$j]['book_id'] = $book_id;
                        $inputs[$i][$j]['page_id'] = $page_id;
                        $inputs[$i][$j]['text'] = $params['line_'.$i.'_'.$j];
                    }
                }
            }

        }
        foreach($inputs as $input) {
            foreach($input as $arr) {
                $final_array[] = $arr;
            }
        }
        return $final_array;
	}
}
