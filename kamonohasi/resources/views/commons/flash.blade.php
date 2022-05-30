@if($errors->count())
    <div class="alart">
        @foreach($errors->all() as $error)
            <p><i class="fa-solid fa-circle-exclamation"></i><span>{{ $error }}</span></p>
        @endforeach
    </div>
@endif
