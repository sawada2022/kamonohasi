if(document.getElementById('deleteUserBtn') != null){
    document.getElementById('deleteUserBtn').onclick = function deleteUser() {
        event.preventDefault();
        if (window.confirm('本当に削除しますか？')){
            document.getElementById('user-delete').submit();
        }
    }
}
