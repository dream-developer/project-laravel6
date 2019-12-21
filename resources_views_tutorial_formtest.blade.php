<form action="{{ url('tutorial/formtest') }}" method="POST">
    @method('PATCH')
    @csrf
    <input type="text" name="title" value="">
    <button type="submit" name="formtest">送信</button>
</form>
