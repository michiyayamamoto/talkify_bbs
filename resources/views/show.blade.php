@extends("base")

@section("main")

<div class="border my-2 p-2">
    <div class="text-secondary">{{ $topic->name }} さん</div>
    <div class="p-2">{!! nl2br(e($topic->content)) !!}</div>
    <div class="text-secondary">投稿日:{{ $topic->created_at }}</div>
</div>

<h2>コメント投稿</h2>

<form action="" method="POST">
{{ csrf_field() }}
<input type="text" name="name" placeholder="名前">
<textarea class="form-control" name="content" placeholder="コメント"></textarea>
<input class="form-control" type="submit" value="送信">
</form>

<h2>投稿されたコメント</h2>

@forelse($comments as $comment )
<div class="border my-2 p-2">
    <div class="text-secondary">{{ $comment->name }} さん</div>
    <div class="p-2">{!! nl2br(e($comment->content)) !!}</div>
    <div class="text-secondary">投稿日:{{ $comment->created_at }}</div>
</div>
@empty
<p>まだコメントはありません</p>
@endforelse

@endsection