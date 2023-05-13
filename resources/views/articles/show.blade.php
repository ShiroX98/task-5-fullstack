@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $article->title }}</h3>
                        <div class="text-muted">
                            <small>by {{ $article->user->name }} | {{ $article->created_at->format('d M Y') }}</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @if ($article->image)
                                <img src="{{ asset('storage/images/' . $article->image) }}" class="img-fluid mx-auto d-block"
                                    style="max-width: 25%;">
                            @endif
                        </div>
                        <p class="card-text">{{ $article->content }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
