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
        $rental_flag = 1;
        $book_flag = 1; //初期値を1(表示しない)とする

        $users = User::where('id', '=', $request->user_id)->first(); //Userを取得
        $book_id = $request->input('book_id'); //渡ってきたbook_idを格納
        $book_ids = $request->session()->get('bookinfo'); 
        if(!is_array($book_ids)) $book_ids=[]; //sessionに保存されているカート内のbook_idをbook_ids[]配列として取得
        $books=[];//配列の初期化
        foreach(array_unique($book_ids) as $i){
            $books[] = Book::where('id', '=', $i)->first(); //渡ってきたbook_id追加前のカートを作成
        }
        // 現在貸し出している本を取得
        $rentals=[];
        $rentalsAll = Rental::where('user_id', '=', $request->user_id)->where('rental_status', '=', 0)->get();
        if(count($rentalsAll)){
            foreach($rentalsAll as $rental){
                $rentals[] = Book::where('id', '=', $rental->book_id)->first();
            }
            $rental_flag = 0;
        }
                    //ここまで、必要な返り値と毎回の処理に必要な変数の準備//

        if(!empty($book_id)){ //リクエストによりbook_idが追加された場合
            
            $book_flag = 0; //資料情報を表示するフラグに変更
            $rental_count = Rental::where('user_id', '=', $request->user_id)->where('rental_status', '=', 0)->count(); //usersが借りている冊数を取得
            
            if(count($book_ids) + $rental_count >= 5 ){ //$book_ids+$rental_countが5以上ならエラーにする

                return view('rentals/create',['books' => $books, 'users' => $users,'book_flag' => $book_flag,'rental_flag' => $rental_flag, 'rentals' => $rentals, 'rentalsAll' => $rentalsAll])
                ->withErrors(["max_books"=>"5冊以上の資料の貸し出しはできません"]);//viewのメソッドで、bladeテンプレートにエラーを渡す

            }else{ //$book_ids+$rental_countが5以下ならbooks_ids(bookinfo)にbook_idを追加する

                $rental_status = Rental::where('book_id', '=', $book_id)->orderBy('id', 'desc')->first(); //渡ってきたbook_idのrental_statusを取得
                if($rental_status === NULL || $rental_status->rental_status === 1){  //book_idの本が借りられる状態ならば
                    if(in_array($book_id, $book_ids) === false){ //book_ids内にbook_idの被りが無いならば
                    $request->session()->push('bookinfo', $book_id); //book_infoにbook_idを追加
                    }
                    $book_ids = $request->session()->get('bookinfo');
                    if(!is_array($book_ids)) $book_ids=[]; 
                    $books=[];//配列の初期化
                    foreach(array_unique($book_ids) as $i){
                        $books[] = Book::where('id', '=', $i)->first(); //book_id追加後のカートを作成
                    }

                }else{ //借りられる状態でないならば
                    return view('rentals/create',['books' => $books, 'users' => $users,'book_flag' => $book_flag,'rental_flag' => $rental_flag, 'rentals' => $rentals, 'rentalsAll' => $rentalsAll])
                ->withErrors(["now_rentaled"=>"現在貸出中の資料です"]);
                }                    
            }   

        }else{//book_idが渡ってこない初回、削除ボタン用
            $index = $request->delete_index;
            if(!is_null($index)){ //削除ボタン用
            unset($book_ids[$index]);
            $request->session()->remove('bookinfo');
            foreach($book_ids as $book_id){
                $request->session()->push('bookinfo', $book_id);
            }
            
            $book_flag = 0;
            }else{ //初回用
            session_start();
            $request->session()->remove('bookinfo');
            $books=[];
            }
        }
        return view('rentals/create', ['books' => $books, 'users' => $users,'book_flag' => $book_flag,'rental_flag' => $rental_flag, 'rentals' => $rentals, 'rentalsAll' => $rentalsAll]);
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
        
        $created_at = $request->input('created_at');
        $rentaldate = date("Y-m-d",$created_at.strtotime("+0 day"));
        $deadline = date("Y-m-d",$created_at.strtotime("+10 day"));
        //dd($deadline);

        $rentals = $request->session()->get('bookinfo');
        foreach($rentals as $rental){
            $book = Book::find($rental);
            $books[] = $book;
            $users->rental_books()->attach($book->id,['deadline' => $deadline]);
        }
        
        return view('rentals/show', ['books' => $books, 'users' => $users, 'rentaldate' => $rentaldate, 'deadline' => $deadline]);
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
