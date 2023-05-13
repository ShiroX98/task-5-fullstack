@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">List of Articles</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">Create Article</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ Str::limit($article->content, 50, '...') }}</td>
                                        <td>{{ $article->category->name }}</td>
                                        <td>{{ $article->user->name }}</td>
                                        <td>
                                            @if ($article->image)
                                                <img src="{{ asset('storage/images/' . $article->image) }}"
                                                    alt="{{ $article->title }}" width="100">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Action buttons">
                                                <a href="{{ route('articles.show', $article->id) }}"
                                                    class="btn btn-info btn-sm mx-1">View</a>
                                                <a href="{{ route('articles.edit', $article->id) }}"
                                                    class="btn btn-warning btn-sm mx-1">Edit</a>
                                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm mx-1">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $articles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
