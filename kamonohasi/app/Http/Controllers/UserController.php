<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Rental;
use App\Rules\PostalCode;
use App\Rules\Tel;
use App\Rules\Email;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        $email = $request->input('email');
        $this->validate($request,[
            'email'=>'max:100'
        ]);

        if(!empty($email)){
            if(User::where('email', '=', $email)->first()){
                $users = User::where('email', '=', $email)->first();
                $rental_hist = Rental::where('user_id', '=', $users->id)->where('rental_status', '=', 1)->orderBy('created_at','desc')->get();
                if(count($rental_hist)){
                    foreach($rental_hist as $hist){
                        $book_hist[] = Book::where('id', '=', $hist->book_id)->first();
                    }
                    $rental_flag = 0; //貸出履歴あり
                }else{
                    $book_hist = [];
                    $rental_flag = 1; //貸出履歴なし
                }
                $rentals = Rental::where('user_id', '=', $users->id)->where('rental_status', '=', 0)->get();
                if(count($rentals)){
                    foreach($rentals as $rental){
                        if(Book::where('id', '=', $rental->book_id)->first()){
                            $books[] = Book::where('id', '=', $rental->book_id)->first();
                        }
                    }
                    if(count($books)){
                        $flag = 1; //貸出中あり
                    }else{
                        $books[] = Book::first();
                        $flag = 2; //貸出中無
                    }
                }else{
                    $books[] = Book::first();
                    $flag = 2; //貸出中無
                }
                return view('users/show', ['users' => $users, 'flag' => $flag, 'books' => $books, 'rental_flag' => $rental_flag, 'book_hist' => $book_hist, 'rental_hist' => $rental_hist]);
            }else{
                $users = User::first();
                $flag = 0;
            }
        }else{
            $users = User::first();
            $flag = 1;
        }
        return view('users/index', ['users' => $users, 'flag' => $flag, 'email' => $email]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //「http://localhost:8000/users/create」でアクセスすると表示できた！

        $user = new User;
        return view('users/create', ['user' => $user]);
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
            'user_name' => 'required|max:40',
            'adress' => 'required|max:100',
            'tel' => ['max:20', 'required', new Tel],
            'email'=> ['max:100','unique:users', 'required', new Email],
            'postal_code'=>['max:20', new PostalCode],
        ]);
        User::create($request->all());
        $request->session()->regenerateToken();
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $books = [];
        $user = $request->input('user');
        if(!empty($user)){
            if(User::where('id', '=', $user)->first()){
                $users = User::where('id', '=', $user)->first();
                $rental_hist = Rental::where('user_id', '=', $users->id)->where('rental_status', '=', 1)->orderBy('created_at','desc')->get();
                if(count($rental_hist)){
                    foreach($rental_hist as $hist){
                        $book_hist[] = Book::where('id', '=', $hist->book_id)->first();
                    }
                    $rental_flag = 0; //貸出履歴あり
                }else{
                    $book_hist = [];
                    $rental_flag = 1; //貸出履歴なし
                }
                $rentals = Rental::where('user_id', '=', $users->id)->where('rental_status', '=', 0)->get();
                if(count($rentals)){
                    foreach($rentals as $rental){
                        if(Book::where('id', '=', $rental->book_id)->first()){
                            $books[] = Book::where('id', '=', $rental->book_id)->first();
                        }
                    }
                    if(count($books)){
                        $flag = 1; //貸出中あり
                    }else{
                        $books[] = Book::first();
                        $flag = 2; //貸出中無
                    }
                }else{
                    $books[] = Book::first();
                    $flag = 2; //貸出中無
                }
            }else{
                $users = User::first();
                $flag = 0;
            }
        }else{
            $users = User::first();
            $flag = 1;
        }
        return view('users/show', ['users' => $users, 'flag' => $flag, 'books' => $books, 'rental_flag' => $rental_flag, 'book_hist' => $book_hist, 'rental_hist' => $rental_hist]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //「http://localhost:8000/users/2/edit」でアクセスすると表示できた！
        return view('users/edit',['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'user_name' => 'required|max:40',
            'adress' => 'required|max:100',
            'tel' => ['max:20', 'required', new Tel],
            'email'=> ['max:100', 'required', new Email, Rule::unique('users')->ignore($user->id)],
            'postal_code'=>['max:20', new PostalCode],
        ]);
        $user->update($request->all());
        $rentals = Rental::where('user_id', '=', $user->id)->where('rental_status', '=', 0)->get();
        if(count($rentals)){
            foreach($rentals as $rental){
                $books[] = Book::where('id', '=', $rental->book_id)->first();
            }
            $flag = 1; //貸出中あり
        }else{
            $books[] = Book::first();
            $flag = 2; //貸出中無
        }
        return view('users/show', ['users' => $user, 'flag' => $flag, 'books' => $books]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->delete();
        return redirect(route('users.index', $user));
    }
}
