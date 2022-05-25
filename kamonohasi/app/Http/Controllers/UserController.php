<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Rental;

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
        
        if(!empty($email)){
            if(User::where('email', '=', $email)->first()){
                $users = User::where('email', '=', $email)->first();
                $rentals = Rental::where('user_id', '=', $users->id)->get();
                if(count($rentals)){
                    foreach($rentals as $rental){
                        $books[] = Book::where('id', '=', $rental->book_id)->first();
                    }
                    $flag = 1;
                }else{
                    $books[] = Book::first();
                    $flag = 0;
                }
                return view('users/show', ['users' => $users, 'flag' => $flag, 'books' => $books]);
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
        $users = new User;
        return view('users/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create($request->all());
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
        $email = $request->email;
        
        if(!empty($email)){
            $users = User::where('email', '=', $email)->first();
            $rentals = Rental::where('user_id', '=', $users->id)->all();
        }else{
            $users = User::first();
        }        
        return view('users/show', ['users' => $users]);


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
        $user->update($request->all());
        return redirect(route('users.show', $user));
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
        return redirect(route('users.show', $user));
    }
}
