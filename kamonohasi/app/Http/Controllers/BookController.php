<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Rental;
use App\Models\User;
use App\Rules\Isbn;
use Illuminate\Validation\Rule;
use App\Rules\CategoryRule;

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
            'isbn' => ['max:13', new Isbn],
            'title' => 'max:100',
            'author'=>'max:100',
            'publisher'=>'max:100',
        ]);
        $flag = 1;
        if($request){
        $query = Book::query();
        if($request->title){
            $query->where('title', 'LIKE', '%'. $request->title .'%');
            $flag = 0;
        }
        if($request->author){
            $query->where('author', 'LIKE', '%'. $request->author .'%');
            $flag = 0;
        }
        if($request->keyword){
            $query->where('title', 'LIKE', '%'. $request->title .'%')
            ->orWhere('author', 'LIKE', '%'. $request->author .'%');
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
    }
    else{
        $books = Book::first();
    }
    $categories=Category::get();
        return view('books.index', ['books' => $books, 'flag' => $flag,'categories'=>$categories]);
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
            'isbn' => ['max:13', 'required', new Isbn],
            'title' => 'required|max:100',
            'author'=>'max:100',
            'publisher'=>'max:100',
            'category_id'=>['required', new CategoryRule],
        ]);
        Book::create($request->all());  
        $request->session()->regenerateToken();    
        return redirect(route('books.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $rental_hist = Rental::where('book_id', '=', $book->id)->where('rental_status', '=', 1)->orderBy('created_at','desc')->get();
        if(count($rental_hist)){
            foreach($rental_hist as $hist){
                $user_hist[] = User::where('id', '=', $hist->book_id)->first();
            }
            $rental_flag = 0; //貸出履歴あり
        }else{
            $user_hist = [];
            $rental_flag = 1; //貸出履歴なし
        }

        $rentals = Rental::where('book_id', '=', $book->id)->first();
        if($rentals === NULL || $rentals->rental_status === 1){ //借りられる状態ならば
            return view('books/show', ['book' => $book, 'flag' => 0, 'rental_flag' => $rental_flag, 'user_hist' => $user_hist]);
        }else{
            $users = User::where('id', '=', $rentals->user_id)->first();
        return view('books/show', ['book' => $book, 'flag' => 1,'users'=> $users, 'rental_flag' => $rental_flag, 'user_hist' => $user_hist]); 
        }
        
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
            'isbn' => ['max:13', 'required', new Isbn],
            'title' => 'required|max:100',
            'author'=>'max:100',
            'publisher'=>'max:100',
            'category_id'=>['required', new CategoryRule],
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
    public function destroy(Book $book)
    {
        Book::where('id', $book->id)->delete();
        return redirect(route('books.index', $book));
    }
}
