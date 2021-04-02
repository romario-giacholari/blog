@extends('layouts.app')
@if($viewModel != null && $viewModel->pageTitle != null)
@section('title', $viewModel->pageTitle)
@endif
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div><a href="{{ route('posts.create') }}" class="btn btn-success btn-xs" title="New post">New post</a></div>
        <hr />
            @if($viewModel != null && !empty($viewModel->posts))
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewModel->posts as $post)
                        <tr>
                            <td><a href="{{ route('posts.show' , ['slug' => $post->slug]) }}">{{ $post->title }}</a></td>
                            <td> {{ $post->created_at->diffForHumans() }}</td>
                            <td> {{ $post->updated_at->diffForHumans() }} </td>
                            <td><a href="{{ route('posts.edit', ['slug' => $post->slug]) }}" class="btn btn-xs btn-primary" role="button">edit</a></td>
                            <td>
                                <form action="{{ route('posts.destroy', ['slug' => $post->slug]) }}" method="POST">

                                    {{ method_field('DELETE') }}

                                    {{ csrf_field() }}

                                    <button class="btn btn-xs btn-danger" role="button">delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p>There are no posts to display. <a href="{{ route('dashboard.index') }}">Redirect to dashboard</a></p>
            @endif
        </div>
    </div>
</div>
@endsection
@if($viewModel != null && !empty($viewModel->posts))
@section('scripts')
<script defer src="https://assets.giacholari.com/js/blog/forms/delete.js"></script>
@endsection
@endif