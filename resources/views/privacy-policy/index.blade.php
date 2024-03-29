@extends('layouts.app')
@section('title', $viewModel->pageTitle)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Privacy policy</h1>
            <hr />
            <div id="js-privacy-policy-content-placeholder">
               @include('privacy-policy.placeholder')
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script defer src="https://assets.giacholari.com/js/blog/privacy-policy/fetchContent.js"></script>
@endsection