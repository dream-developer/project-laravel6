<form action="{{ url('tutorial') }}" method="POST">
    @csrf
    タイトル<br>
    <input type="text" name="title" value="{{old('title')}}"><br>
    本文<br>
    <textarea name="body" >{{old('body')}}</textarea><br>
    <button type="submit">送信</button>
</form>