<?php
namespace Admin\Services;
use App\Models\Book;
use App\Models\Page;
use App\Models\Line;
use App\Models\Section;
use DB;
use App\Exceptions\Custom\FailedTransactionException;

class SectionService
{
    public function __construct(Book $book, Page $page, Line $line, Section $section){
        $this->book = $book;
        $this->page = $page;
        $this->line = $line;
        $this->section = $section;
    }
}