@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Article') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('articles.update', $article->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="title"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                        class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ $article->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="content"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                                <div class="col-md-6">
                                    <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" required
                                        autocomplete="content" rows="5">{{ $article->content }}</textarea>

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" accept="image/*">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @if ($article->image)
                                        <img src="{{ asset('storage/images/' . $article->image) }}"
                                            alt="{{ $article->title }}" class="img-thumbnail mt-3">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mt-2">
                                <label for="category_id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                                <div class="col-md-6">
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $article->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0 mt-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
