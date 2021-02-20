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
        <div class="col-md-2">
            <div class="form-group">
                <select name="orderBy" id="orderBy">
                    <option {{ $viewModel->orderBy == 'created_at' ? 'selected' : '' }} value="created_at">Newest first</option>
                    <option {{ $viewModel->orderBy == 'views'      ? 'selected' : '' }} value="views">Top views</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($viewModel->posts as $post)
        <div class="col-md-12">
            <div class="caption">
                <a href="{{ route('posts.show',['slug' => $post->slug]) }}">{{ $post->title }} </a> | posted: <span>{{ $post->created_at->diffForHumans() }}</span> | views: <span>{{ $post->views }}</span>
                <p class="post-body">{!! $post->excerpt !!}</p>
            </div>
            <hr />
        </div>
        @endforeach
    </div>

    <div>
        {{ $viewModel->posts->withQueryString()->links() }}
    </div>
</div>
@endsection
@section('scripts')
<script defer>
    document.addEventListener("DOMContentLoaded", function () {
        var orderByInput = document.getElementById("orderBy");
        orderByInput.addEventListener("change", function () {
            var currentValue = this.value;

            if (currentValue !== undefined && currentValue !== '') {
                var uri = "/posts?orderBy=" + currentValue;
                var encodedUri = encodeURI(uri);
                window.location.href = encodedUri;
            }
        });
    });
</script>
@endsection
@else
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p>Blog posts coming soon.</p>
        </div>
    </div>
</div>
@endsection
@endif