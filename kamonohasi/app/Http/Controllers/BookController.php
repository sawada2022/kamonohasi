<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request,[
            'isbn' => 'max:13',
            'title' => 'max:100',
            'author'=>'max:100',
            'publisher'=>'max:100',
        ]);
        $flag = 1;
        if($request){
        $query = Book::query();
        if($request->title){
            $query = Book::where('title', 'LIKE', '%'. $request->title .'%');
            $flag = 0;
        }
        if($request->author){
            $query = Book::where('author', 'LIKE', '%'. $request->author .'%');
            $flag = 0;
        }
        if($request->keyword){
            $query = Book::where('title', 'LIKE', '%'. $request->title .'%')
            ->orWhere('author', 'LIKE', '%'. $request->author .'%');
            $flag = 0;
        }
        if($request->book_id){
            $query = Book::where('id', '=', $request->book_id);
            $flag = 0;
        }
        if($request->genre){
            $query = Book::where('category_id', '=', $request->genre);
            $flag = 0;
        }
        if($request->published_year){
            $query = Book::where('publised_on', '=', $request->published_year);
            $flag = 0;
        }
        $books = $query->orderBy('created_at')->paginate(10);
    }
    else{
        $books = Book::first();
    }
        return view('books.index', ['books' => $books, 'flag' => $flag]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = new Book;
        $categories = Category::all();
        return view('books/create',['book'=>$book,'categories'=>$categories]); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'isbn' => 'required|max:13',
            'title' => 'required|max:100',
            'author'=>'max:100',
            'publisher'=>'max:100'
        ]);
        Book::create($request->all());      
        return redirect(route('books.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit',['book' => $book, 'categories' => $categories]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request,[
            'isbn' => 'required|max:13',
            'title' => 'required|max:100',
            'author'=>'max:100',
            'publisher'=>'max:100'
        ]);
        $book->update($request->all());
        return redirect(route('books.show', $book));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
