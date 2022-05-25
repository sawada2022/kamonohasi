<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Rental;


class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $user_id = $request->input('user_id');
        $book_flag = 1;

        if(!empty($user_id)){
            $users = User::where('id', '=', $user_id)->first();
            $flag = 0;
        }else{
            $users = User::first();
            $flag = 1;
        }
        
        return view('rentals/index', ['users' => $users, 'flag' => $flag,'book_flag' => $book_flag]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) //リクエストを受け、会員情報・資料情報を表示
    {
        //dd($request);
        $users = User::where('id', '=', $request->users)->first();
        $books=[];//booksが入ってない空配列を用意
        $book_flag = 1;
        $book_id = $request->input('book_id');

        //リクエストを受け、資料情報を表示
        if(!empty($book_id)){
            $users = User::where('id', '=', $request->user_id)->first();
            $request->session()->push('bookinfo', $book_id);
            foreach(array_unique($request->session()->get('bookinfo')) as $i){
                $books[] = Book::where('id', '=', $i)->first();
            }
            $book_flag = 0;
        }else{//初回用
            session_start();
            $request->session()->remove('bookinfo');
        }

        return view('rentals/create', ['books' => $books, 'users' => $users,'book_flag' => $book_flag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //会員IDと資料IDをrentalsテーブルに保存
    {
        $user_id_rental = $request->input('user_id_rental');
        $users = User::find($user_id_rental);

        $rentals = $request->session()->get('bookinfo');
        foreach($rentals as $rental){
            $book = Book::find($rental);
            $books[] = $book;
            $users->rental_books()->attach($book->id);
        }
        
        return view('rentals/show', ['books' => $books, 'users' => $users]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) //貸出完了画面表示
    {
        return view('rentals/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $user_id)
    {
        $user = User::where('id', '=', $user_id)->first();
        $flag = 1;
        $rentals = Rental::where('user_id', '=', $user_id)->where('rental_status', '=', 0)->get(); 
        $books = [];
        foreach($rentals as $rental){
                $books[] = Book::where('id', '=', $rental->book_id)->first();
                $flag = 0;
            }
        $index = $request->delete_index;

        if(!is_null($index)){
            $request->session()->push('deleteinfo', $index);
            //dd(array_unique($request->session()->get('deleteinfo')));
            foreach(array_unique($request->session()->get('deleteinfo')) as $i){
                unset($books[$i]);
            }
            $flag = 0;
        }else{//初回用
            session_start();
            $request->session()->remove('deleteinfo');

        }
        return view('rentals.edit', ['user' => $user, 'flag' => $flag, 'books' => $books]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) 
    {

            $users = User::where('id', '=', $request->user_id)->first();
            $rentals = Rental::where('user_id', '=', $users->id)->where('rental_status', '=', 0)->get(); //かつrental_status==0
            foreach($rentals as $rental){
                $rental->rental_status = 1;
                $rental->save();
            }
            $flag = 1;
            $book_flag = 1;
        return view('rentals.index', ['users' => $users, 'flag' => $flag,'book_flag' => $book_flag]);
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
