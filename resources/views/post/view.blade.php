@extends('_layouts.app')

@section('title')CRUD Data Post @endsection

@section('content')
<div class="row py-3">
    <div class="col-md-12">
        <a href="{{ route('post.index') }}" class="btn btn-primary my-4">Kembali</a>

        <h1>{{ $post->title }}</h1>

        <p>{{ $post->body }}</p>
    </div>
</div>
@endsection