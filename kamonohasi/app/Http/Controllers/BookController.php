<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $flag = 1;
        if($request){
        $query = Book::query();
        if($request->title){
            $query->where('title', 'LIKE', '%'.$request->title.'%');
            $flag = 0;
        }
        if($request->author){
            $query->where('author', 'LIKE', '%'.$request->author.'%');
            $flag = 0;
        }
        if($request->keyword){
            $query->where('title', 'LIKE', '%'.$request->title.'%')
            ->orWhere('author', 'LIKE', '%'.$request->author.'%');
            $flag = 0;
        }
        if($request->book_id){
            $query->where('id', '=', $request->book_id);
            $flag = 0;
        }
        if($request->genre){
            $query->where('category_id', '=', $request->genre);
            $flag = 0;
        }
        if($request->published_year){
            $query->where('publised_on', '=', $request->published_year);
            $flag = 0;
        }
        $books = $query->orderBy('created_at')->paginate(10);
        var_dump($query);
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
        return view('books.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$book = $request->create($request->all());
        return redirect(route('books/create'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
