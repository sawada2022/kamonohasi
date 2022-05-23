<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) //リクエストを受け、会員情報・資料情報を表示
    {
        //入力された個人IDの取得
        $user_id = $request->input('user_id');
        $user_flag = 1;
        if(!empty($user_id)){
            $users = User::where('id', '=', $user_id)->first();
            $user_flag = 0;
        }else{
            $users = User::first();
        }
        //入力された資料IDの取得
        $book_id = $request->input('book_id');

        $book_flag = 1;
        if(!empty($book_id)){
            $books = Book::where('id', '=', $book_id)->first();
            $book_flag = 0;
        }else{
            $books = Book::first();
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
