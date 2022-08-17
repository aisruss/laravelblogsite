@extends('layouts.app')

@section('title', 'New Post')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Post') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/blog">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <div class="control">
                                        <input id="title" type="text" class="input {{ $errors->has('title') ? 'is-danger' : '' }}" name="title"  value="{{ old('title') }}" autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                                <div class="col-md-6">
                                    <div class="control">
                                        <textarea class="textarea {{ $errors->has('content') ? 'is-danger' : '' }}" name="content">{{ old('content') }}</textarea><br>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
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
