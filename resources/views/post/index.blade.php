@extends('_layouts.app')

@section('title')CRUD Data Post @endsection

@section('content')
<div class="row py-3">
    <div class="col-md-12">
         
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif 

        <div class="row">
            <div class="col-md-8">
                <form class="form-inline " method="get" action="{{ url('post/search') }}">  

                    <input type="text" class="form-control mb-2 mr-sm-2" name="title" id="title" placeholder="Enter Title" autofocus value="{{ (isset($input))?$input:'' }}">
                      
                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
                </form>
            </div>
            <div class="col-md-4 text-right"> 
                <a href="{{ route('post.create') }}" class="btn btn-primary">Tambah Data</a> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <th>No.</th>
                        <th>Judul</th> 
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @if (empty($posts))
                            <tr>
                                <td colspan="5">Tidak ada Data</td>
                            </tr>
                        @else
                            @php
                                $no = $posts->currentPage();
                                $count = (($posts->currentPage() - 1 ) * $posts->perPage() ) + $no;
                            @endphp
                            @foreach ($posts as $value)
                            <tr>
                                <td>{{ $count++ }}.</td>
                                <td>{{$value->title}}</td>  
                                <td> 
                                    <form action="{{ route('post.destroy',$value->id) }}" method="POST">
                                        <a href="{{ route('post.show', $value->id) }}" class="btn btn-primary">Lihat</a>
                                        <a href="{{ route('post.edit', $value->id) }}" class="btn btn-warning">Edit</a> 
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr> 
                            @endforeach 
                        @endif
                    </tbody>
                </table> 
            </div>
        </div>

        <div class="text-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection