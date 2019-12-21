ID:{{ $message->id }}<br>
カテゴリー:{{$message->category->name}}<br>
ユーザー:{{ $message->user->name }}<br>
タイトル:{{ $message->title }}<br>              
本文:<br>{!! nl2br(e($message->body)) !!}<br>              
作成日時:{{ $message->created_at }}<br>
更新日時:{{ $message->updated_at }}<br>
