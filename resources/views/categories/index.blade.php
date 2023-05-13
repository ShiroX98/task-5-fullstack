@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Categories') }}</div>

                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{ __('Created By') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            <a href="{{ route('categories.show', $category->id) }}"
                                                class="btn btn-sm btn-primary">{{ __('Show') }}</a>
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-sm btn-secondary">{{ __('Edit') }}</a>
                                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}"
                                                style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
