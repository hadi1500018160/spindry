@extends('app')

@section('title','Service')
@section('page-heading','Service')

@section('content')
<div class="page-content">
    <section class="row ">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ url('/service/create') }}" class="btn btn-primary">Tambah data</a>
            </div>
        </div>
        <div class="row">
            <div class="col-5">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        <i class="fa-solid fa-square-check fa-beat-fade"></i>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="row mb-5">
                        <div class="col-4">
                            <div class="form-grup">
                                <select name="pagination" id="pagination" class="form-control">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>20</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="q" value="{{ $q }}"
                                    placeholder="Cari">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </form>


                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>No.</th>
                                    <th>Logo</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration + $services->perPage() * ($services->currentPage() - 1) }}
                                            </td>
                                            <td>{{  $service->logo }}</td>
                                            <td>{{  $service->title }}</td>
                                            <td>{{  $service->price }}</td>
                                            <td>{!!  $service->description !!}</td>
                                            <td>
                                                <a href="{{ url('/service/' . $service->id . '/edit') }}"
                                                    class="btn btn-warning"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <form class="d-inline" action="{{ url('/service/' . $service->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">
                                                        <i class="fa-solid fa-trash"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

 