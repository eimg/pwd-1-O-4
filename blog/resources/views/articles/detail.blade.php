@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px">
        <div class="card mb-2 bg-white border-primary">
            <div class="card-body">
                <h3 class="card-title">{{ $article->title }}</h3>
                <div class="text-muted">
                    Category: {{ $article->category->name }},
                    {{ $article->created_at }}
                </div>
                <p>{{ $article->body }}</p>
                
                @auth
                    <a href="{{ url("/articles/delete/$article->id") }}"
                        class="btn btn-sm btn-outline-danger">
                        Delete
                    </a>
                @endauth
            </div>
        </div>

        <ul class="mt-4 list-group">
            <li class="list-group-item active">
                Comments ({{ count($article->comments) }})
            </li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    @auth
                        <a href="{{ url("/comments/delete/$comment->id") }}"
                            class="btn-close float-end"></a>
                    @endauth

                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>
        
        @auth
            <form action="{{ url("/comments/create") }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control my-2"></textarea>
                <button class="btn btn-secondary">Add Comment</button>
            </form>
        @endauth
    </div>
@endsection
