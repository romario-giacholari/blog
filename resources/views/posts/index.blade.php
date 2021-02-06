@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@if($viewModel != null && $viewModel->posts !== null && !$viewModel->posts->isEmpty())
@section('content')
<div class="container">
    <h1>Snippets</h1>
    <hr />
    <div class="row">
        @foreach($viewModel->posts as $post)
        <div class="col-md-12">
            <div class="caption">
                <a href="{{ route('posts.show',['slug' => $post->slug]) }}">{{ $post->title }} </a> | <b>posted:</b> <span>{{ $post->created_at->diffForHumans() }}</span> | <b>views:</b> <span>{{ $post->views }}</span>
                <p class="post-body">{!! $post->excerpt !!}</p>
            </div>
            <hr />
        </div>
        @endforeach
    </div>

    <div>
        {{ $viewModel->posts->links() }}
    </div>
</div>
@endsection
@else
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>Blog posts coming soon...</p>
        </div>
    </div>
</div>
@endsection
@endif