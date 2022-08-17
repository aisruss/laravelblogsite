@extends('layouts.app')

@section('title', 'View All')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="h1">Laravel Blog</p>
                @if (session('message'))
                    <p>{{ session('message') }}</p>
                @endif
                @foreach ($blogs as $blog)
                    <div class="card">
                        <div class="card-header">{{ $blog['title'] }}</div>
                        <div class="card-body">
                            <div class="content">
                                <?= strlen($blog['content']) > 50 ? substr($blog['content'],0,500)."..."  : $blog['content']; ?>
                                <a href="/blog/{{ $blog['id'] }}">Read More<a>
                            </div>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated  {{ $blog['updated_at'] }}  by {{ $blog['author'] }}</small>
                        </div>
                    </div>
                    <br>
                @endforeach

            </div>
        </div>
    </div>
@endsection
