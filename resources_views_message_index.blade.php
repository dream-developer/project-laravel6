
{{-- エラー表示 --}}
@include('common.errors')
<a href="{{url("/messages/create")}}">メッセージ作成</a><br>
<table border='1'>
<tr><th>ID</th><th>カテゴリー</th><th>タイトル</th><th>ユーザー</th><th>編集</th><th>削除</th></tr>
@forelse ($messages as $message)
  <tr>
    <td>{{$message->id}}</td>
    <td>{{$message->category->name}}</td>
    <td><a href="{{url("/messages/{$message->id}")}}">{{$message->title}}</a></td>              
    <td>{{$message->user->name}}</td>
    @if($message->user_id == Auth::id())
    <td><a href="{{url("/messages/{$message->id}/edit")}}">編集</a></td>              
    <td>
      <form action="{{url("/messages/{$message->id}")}}" method="POST">
      @method('DELETE')
      @csrf
      <button type="submit">削除</button>
      </form>    
    </td>
    @else
    <td></td><td></td>
    @endif
  </tr>
@empty
  <tr>
    <td>メッセージがありません</td>
  </tr>
@endforelse
</table>
<br>{{-- ページリンク --}}
@unless(is_null($messages->previousPageUrl()))
  <a href="{{ $messages->previousPageUrl() }}">前へ</a>
@endunless
@unless(is_null($messages->previousPageUrl()) && is_null($messages->nextPageUrl()))
{{ $messages->currentPage() }} / {{ $messages->lastPage() }} ページ
@endunless
@unless(is_null($messages->nextPageUrl()))
  <a href="{{ $messages->nextPageUrl() }}">次へ</a>
@endunless