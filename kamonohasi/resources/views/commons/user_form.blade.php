    <label>


        名前
        <input type="text" name="user_name" value="{{ old('title', $user->user_name) }}">
    </label>
    <label>
        メールアドレス
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
    </label>
    <label>
        電話番号
        <input type="tel" name="tel" value="{{ old('tel', $user->tel) }}">
    </label>
    <label>
        郵便番号
        <input type="text" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
    </label>
    <label>
        住所
        <input type="text" name="adress" value="{{ old('adress', $user->adress) }}">
    </label>
    <label>
        生年月日
        <input type="date" name="birthday" value="{{ old('birthday', $user->birthday) }}">
    </label>
    <label>
        備考

        <input type="text" name="comment" value="{{ old('comment', $user->comment) }}">
    </label>
