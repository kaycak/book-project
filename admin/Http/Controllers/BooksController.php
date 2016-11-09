<?php

namespace Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Admin\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;
use Admin\Services\BookService;
use App\Exceptions\Custom\FailedTransactionException;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookService $bookService)
    {
        $books = $bookService->getAllBooks();
        return view('admin.books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request, BookService $bookService)
    {
        if(null != $bookService->createBook($request->all())) {
            return redirect('/books')->withSuccess('Book has been successfully created');
        }
        return redirect()->back()->withWarning('Ops. Somethin went wrong. Please try a later');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, BookService $bookService)
    {
        $book = $bookService->getBookById($id);
        dd($book->pages->first()->sections->first()->lines);
        return view('admin.books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, BookService $bookService)
    {
        $book = $bookService->getBookById($id);
        return view('admin.books.create', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, BookService $bookService)
    {
        if(null != $bookService->updateBook($id, $request->all())) {
            return redirect('/books')->withSuccess('Book has been successfully updated');
        }
        return redirect()->back()->withWarning('Ops. Somethin went wrong. Please try a later');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, BookService $bookService)
    {
        if($bookService->deletBookById($id)) {
            return redirect('/books')->withSuccess('Book has been successfully deleted');
        }
        return redirect()->back()->withWarning('Ops. Something went wrong. Please try a later');
    }

    public function addPage($id, BookService $bookService)
    {
        $book = $bookService->getBookById($id);
        return view('admin.books.add-page', ['book' => $book]);
    }

    public function postAddPage($id, BookService $bookService, Request $request)
    {
        try {
            if(null != $bookService->createPage($id, $request->all())){
                return redirect('/books')->withSuccess('Page has been successfully created');
            }
        }
        catch(FailedTransactionException $e)
        {
            if($e->getCode() === -1) {
                return redirect()->back()->withWarning('Ops. Something went wrong. Please try a later');
            }
        }
    }
}
