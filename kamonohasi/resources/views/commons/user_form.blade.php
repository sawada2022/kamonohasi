<div class="searchInputArea">
    <div class="searchFormInputFlex">
        <span>
            <label for="user_name">名前</label>
            <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}">
        </span>
        <span>
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
        </span>
        <span>
            <label for="tel">電話番号</label>
            <input type="tel" id="tel" name="tel" value="{{ old('tel', $user->tel) }}">
        </span>
        <span>
            <label for="postal_code">郵便番号</label>
            <input type="text" id="postal_code"  name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
        </span>
        <span>
            <label for="adress">住所</label>
            <input type="text" id="adress" name="adress" value="{{ old('adress', $user->adress) }}">
        </span>
        <span>
            <label for="birthday">生年月日</label>
            <input type="date" id="birthday" name="birthday" value="{{ old('birthday', $user->birthday) }}">
        </span>
        <span>
            <label for="comment">備考</label>
            <input type="text" id="comment" name="comment" value="{{ old('comment', $user->comment) }}">
        </span>
    </div>
</div>
