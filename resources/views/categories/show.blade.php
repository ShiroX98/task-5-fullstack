@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">{{ $category->name }}</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($articles as $article)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('storage/images/' . $article->image) }}" class="card-img-top"
                            alt="{{ $article->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
