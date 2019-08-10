@if(count($errors->all()) > 0)
    <div class="errors-message-tips">
        @foreach($errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif