@extends('layouts.app')

@section('title', 'View Post')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="h1">{{ $blog['title'] }}</p>
                <hr>
                <div class="content">
                    <p class="card-text">{{ $blog['content'] }} </p>
                    <a href="/blog/{{ $blog['id']}}/edit" class="btn btn-outline-dark">Edit</a>
                </div>
                <small class="text-muted">Last updated  {{ $blog['updated_at']}} by {{ $blog['author'] }}</small>
            </div>
            <div class="col-md-8">
                <br>
                <p class="h3">Comments: </p>
                    @foreach ($blog['blogComments'] as $comment)
                        <div class="card">
                            <div class="card-header">{{ $comment['submitted_by'] }} says:</div>
                            <div class="card-body">
                                <div class="content">
                                    {{ $comment['comment']}}
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Submitted on  {{ $comment['created_at'] }}</small>
                            </div>
                        </div>
                        <br>
                    @endforeach
                <br>
            </div>
            <br>
            <div class="col-md-8">
                {{-- add a new task form --}}
                <form method="POST" action="/blog/{{ $blog['id']}}/blogComments" class="box">
                    @csrf
                    <div class="Field">
                        <label class="Label" for="comment">New Comment</label>

                        <div class="control">
                            <input type="text" class="input {{ $errors->has('comment') ? 'is-danger' : '' }}" value="{{ old('comment') }}" name="comment" placeholder="New Comment">
                        </div>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button is-link">Submit</button>
                        </div>
                    </div>

                    @include('errors')
                </form>
            </div>
        </div>
    </div>


        @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif

@endsection
