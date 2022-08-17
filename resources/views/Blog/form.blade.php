@extends('layouts.app')

@section('title', 'New Post')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Post') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ $action }}">
                            @csrf
                            @if (strtoupper($method) != 'POST')
                                {{ method_field($method) }}
                            @endif
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Blog Title:</label>
                                <div class="col-md-6">
                                    <div class="control">
                                        <input id="title" type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title"  value="{{ $blog->title ?? '' }}" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">Your Post:</label>
                                <div class="col-md-6">
                                    <div class="control">
                                        <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="content">{{ $blog->content ?? '' }}</textarea><br>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ $title }}
                                    </button>
                                </div>
                            </div>
                            @include('errors')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
