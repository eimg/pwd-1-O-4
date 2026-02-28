@extends("layouts.app")

@section("content")
    <div class="container" style="max-width: 600px">

        @if($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $err)
                    {{ $err }}
                @endforeach
            </div>
        @endif

        <form action="{{ url("/articles/create") }}" method="post">
            @csrf
            <input type="text" class="form-control mb-2" name="title" placeholder="Title">
            <textarea class="form-control mb-2" name="body" placeholder="Body"></textarea>
            <select class="form-select mb-2" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button class="btn btn-primary">Add Article</button>
        </form>
    </div>
@endsection
