{{-- エラー表示 --}}
@include('common.errors')
<form action="{{ url('messages') }}" method="POST">
    @csrf
    カテゴリー:
    <select name="category_id" >    
    @foreach ($categories as $category)
       @if($category->id == old('category_id'))
       <option value="{{$category->id}}" selected>{{$category->name}}</option>
       @else
       <option value="{{$category->id}}">{{$category->name}}</option>
       @endif
    @endforeach
    </select>
    <br>
    タイトル:<input type="text" name="title" value="{{old('title')}}"><br>
    本文:<br>
    <textarea name="body">{{old('body')}}</textarea><br>
    <button type="submit">送信</button>
</form>