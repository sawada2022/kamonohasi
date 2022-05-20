<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name',40);//名前
            $table->date('birthday');//誕生日
            $table->string('adress',100);//住所
            $table->string('postal_code',10)->nullable();;//郵便番号
            $table->string('tel',20);//電話番号
            $table->string('email',100)->unique();//メールアドレス
            $table->string('comment')->nullable();//コメント
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
