<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Create;

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
    public function create(Request $request,Book $books) //リクエストを受け、会員情報・資料情報を表示
    {
        //リクエストを受け、資料情報を表示
        $book_id = $request->input('book_id');
        $flag = 1;
        if(!empty($book_id)){
            $book = Book::where('id', '=', $book_id)->first();
            $request->session()->push('bookinfo', $book);// セッションに情報を保存
            // セッションの値を全て取得
            $bookinfo = $request->session()->all();
            $books[] = $bookinfo;
            $flag = 0;
        }else{//初回用
            $books=[];//booksが入ってない空配列を返す
            session_start();
            $_SESSION['bookinfo'] = [];
        }

        return view('rentals/create', ['books' => $books, 'flag' => $flag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //会員IDと資料IDをrentalsテーブルに保存
    {
        //
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
