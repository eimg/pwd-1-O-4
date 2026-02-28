@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px">
        {{ $articles->links() }}

        @if(session("info"))
            <div class="alert alert-info">
                {{ session("info") }}
            </div>
        @endif

        @foreach ($articles as $article)
            <div class="card mb-2 bg-white">
                <div class="card-body">
                    <h3 class="card-title">{{ $article->title }}</h3>
                    <div class="text-muted">
                        <b class="text-success">{{ $article->user->name }}</b>,
                        Category: {{ $article->category->name }},
                        Comments: {{ count($article->comments) }},
                        {{ $article->created_at }}
                    </div>
                    <p>{{ $article->body }}</p>
                    <a href="{{ url("/articles/detail/$article->id") }}">
                        View Detail
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
