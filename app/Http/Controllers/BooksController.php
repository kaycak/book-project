<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LineService;
use App\Services\BookService;
use App\Services\SectionService;

class BooksController extends Controller
{
	protected $lineService;
	protected $bookService;
	protected $sectionService;


	public function __construct(LineService $lineService, BookService $bookService, SectionService $sectionService)
	{
		$this->lineService    = $lineService;
		$this->bookService    = $bookService;
		$this->sectionService = $sectionService;
	}

    public function index($locale, $book_id) {
    	$lines = $this->lineService->getBookLinesByBookId($book_id);
    	return view('lines.index', ['lines' => $lines]);
    }
}
