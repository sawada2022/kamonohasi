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
        
        if(!empty($user_id)){
            $users = User::where('id', '=', $user_id)->first();
            $flag = 0;
        }else{
            $users = User::first();
            $flag = 1;
        }
        
        return view('rentals/index', ['users' => $users, 'flag' => $flag]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) //リクエストを受け、会員情報・資料情報を表示
    {
        //リクエストを受け、資料情報を表示
        $book_flag = 1;
        $book_id = $request->input('book_id');
        if(!empty($book_id)){
            $request->session()->push('bookinfo', $book_id);
            foreach(array_unique($request->session()->get('bookinfo')) as $i){
                $books[] = Book::where('id', '=', $i)->first();
            }
            $book_flag = 0;
        }else{//初回用
            $books=[];//booksが入ってない空配列を返す
            session_start();
        }
        //dd($request->session()->get('bookinfo'));
        //入力された個人IDの取得
        $user_id = $request->input('user_id');
        $user_flag = 1;
        if(!empty($user_id)){
            $users = User::where('id', '=', $user_id)->first();
            $user_flag = 0;
        }else{
            $users = User::first();
        }
        
        //return
        return view('rentals/create', ['books' => $books, 'users' => $users,'user_flag' => $user_flag,'book_flag' => $book_flag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //会員IDと資料IDをrentalsテーブルに保存
    {
        //dd($request);
        $book_id_rental = $request->input('user_id_rental');
        $user_id_rental = $request->input('book_id_rental');
        $user = User::find($user_id_rental);
        $user->rental_books()->attach($book_id_rental);
        //return redirect(route('rentals.show'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) //貸出完了画面表示
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
        if(!empty($id)){
            if(User::where('id', '=', $id)->first()){
                $users = User::where('id', '=', $id)->first();
                $rentals = Rental::where('user_id', '=', $users->id)->get();
                if(count($rentals)){
                    foreach($rentals as $rental){
                        $books[] = Book::where('id', '=', $rental->book_id)->first();
                    }
                }else{
                    $books[] = Book::first();
                }
                $flag = 0;
            }else{
                $users = User::first();
                $books = Book::first();
                $flag = 1;
            }
        }else{
            $users = User::first();
            $books = Book::first();
            $flag = 1;
        }
        return view('rentals.edit', ['user' => $users, 'flag' => $flag, 'books' => $books]);
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
