@extends('_layouts.app')

@section('title')CRUD Data Post @endsection

@section('content')
<div class="row py-3">
    <div class="col-md-12">
        <a href="{{ route('post.index') }}" class="btn btn-primary my-4">Kembali</a>

        @if ($errors->any()) 
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif

        <h2>Tambah Data</h2>
        <form action="{{ route('post.update', $post->id) }}" method="post">  
            @csrf
            <input type="hidden" name="_method" value="PATCH">

            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" value="{{ (old('title'))?old('title'):$post->title }}" class="form-control" name="title" id="title" placeholder="Enter email"> 
            </div>
            <div class="form-group">
                <label for="body">Isi</label>
                <textarea name="body" id="body" class="form-control">{{ (old('body'))?old('body'):$post->body }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection