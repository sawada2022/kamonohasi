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
        $rental_flag = 1;
        $rentals = [];

        if(!empty($user_id)){
            $users = User::where('id', '=', $user_id)->first();
            $rentalsAll = Rental::where('user_id', '=', $users->id)->where('rental_status', '=', 0)->get();
            if(count($rentalsAll)){
                foreach($rentalsAll as $rental){
                    $rentals[] = Book::where('id', '=', $rental->book_id)->first();
                }
                $rental_flag = 0;
            }
            $flag = 0;
        }else{
            $users = User::first();
            $flag = 1;
        }
        
        return view('rentals/index', ['users' => $users, 'flag' => $flag,'book_flag' => $book_flag,'rental_flag' => $rental_flag, 'rentals' => $rentals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) //リクエストを受け、資料情報を表示
    {
        $users = User::where('id', '=', $request->user_id)->first();
        $books=[];//booksが入ってない空配列を用意
        $rental_flag = 1;
        $rentals = [];

        //リクエストを受け、資料情報を表示
        $book_flag = 1;
        $book_id = $request->input('book_id');

        $book_ids = $request->session()->get('bookinfo');
            if(!is_array($book_ids)) $book_ids=[];

        //リクエストを受け、資料情報を表示
        if(!empty($book_id)){
            $book_flag = 0;
            $users = User::where('id', '=', $request->input('user_id'))->first();
            
            if(count($book_ids) >= 5 ){//$book_idsの中身の数を数えて、それが５回以上だったらエラーにしよう
                $books=[];
                foreach(array_unique($book_ids) as $i){
                    $books[] = Book::where('id', '=', $i)->first();
                }
                return view('rentals/create',['books' => $books, 'users' => $users,'book_flag' => $book_flag,'rental_flag' => $rental_flag, 'rentals' => $rentals])
                ->withErrors(["max_books"=>"5冊以上の資料の貸し出しはできません"]);//viewのメソッドで、bladeテンプレートにエラーを渡している

            }else{//１回目にボタンを押したとき
                $rental_status = Rental::where('book_id', '=', $book_id)->orderBy('id', 'desc')->first();
                if($rental_status->rental_status === 1){
                    if(in_array($book_id, $book_ids) === false){
                    $request->session()->push('bookinfo', $book_id);
                    }
                }else{
                    return view('rentals/create',['books' => $books, 'users' => $users,'book_flag' => $book_flag,'rental_flag' => $rental_flag, 'rentals' => $rentals])
                ->withErrors(["now_rentaled"=>"現在貸出中の資料です"]);
                }
                $books=[];//配列の初期化
                foreach(array_unique($book_ids) as $i){
                        $books[] = Book::where('id', '=', $i)->first();    
                }
                    
            }
                
            

        }else{//初回用、削除ボタン用
            $index = $request->delete_index;
            if(!is_null($index)){
            unset($book_ids[$index]);
            $request->session()->remove('bookinfo');
            foreach($book_ids as $book_id){
                $request->session()->push('bookinfo', $book_id);
            }
            $books=[];//配列の初期化
                foreach(array_unique($book_ids) as $i){
                    $books[] = Book::where('id', '=', $i)->first();
                }
            $book_flag = 0;
            }else{
            session_start();
            $request->session()->remove('bookinfo');
            }
        }


        // 現在貸し出している本を取得
        $rentalsAll = Rental::where('user_id', '=', $request->user_id)->where('rental_status', '=', 0)->get();
        if(count($rentalsAll)){
            foreach($rentalsAll as $rental){
                $rentals[] = Book::where('id', '=', $rental->book_id)->first();
            }
            $rental_flag = 0;
        }

        return view('rentals/create', ['books' => $books, 'users' => $users,'book_flag' => $book_flag,'rental_flag' => $rental_flag, 'rentals' => $rentals]);
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
            $rentals = Rental::where('user_id', '=', $users->id)->where('rental_status', '=', 0)->get();
            if($request->session()->get('deleteinfo')){
            foreach(array_unique($request->session()->get('deleteinfo')) as $i){
                unset($rentals[$i]);
            }
            }   
            foreach($rentals as $rental){
                $rental->rental_status = 1;
                $rental->save();
            }
            $flag = 1;
            $book_flag = 1;
        //return view('rentals.index', ['users' => $users, 'flag' => $flag,'book_flag' => $book_flag]);
        return redirect(route('rentals.index',['users'=>$users]));
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
