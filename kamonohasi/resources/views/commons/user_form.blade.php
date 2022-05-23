    <label>
        会員ID
        <input type="text" name="user_id" value="{{ old('user_id') }}">
    </label>
    <label>
        名前
        <input type="text" name="user_name" value="{{ old('user_name') }}">
    </label>
    <label>
        メールアドレス
        <input type="email" name="mail_adress" value="{{ old('email_adress') }}">
    </label>
    <label>
        電話番号
        <input type="tel" name="tel" value="{{ old('tel') }}">
    </label>
    <label>
        郵便番号
        <input type="text" name="postal_code" value="{{ old('postal_code') }}">
    </label>
    <label>
        住所
        <input type="text" name="adress" value="{{ old('adress') }}">
    </label>
    <label>
        生年月日
        <input type="date" name="birthday" value="{{ old('birthday') }}">
    </label>
    <label>
        備考
        <input type="text" name="remarks" value="{{ old('remarks') }}">
    </label>
