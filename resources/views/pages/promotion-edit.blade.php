@extends('app')
@section('title','edit-promotion')
@section('page-heading', 'edit-promotion')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="row-12">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        {{-- METHOD [POST] UNTUK KURIR NGAMBIL DARI ROUTER --}}
                        {{-- csrf berfungsi untuk token atau nomer  --}}
                        <form action="{{ url('/promotion/'.$promotion->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- --}}
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"  id="title" name="title" value="{{$promotion->title}}">
                                
                            </div>
                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount</label>
                                <input type="number" class="form-control  @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{$promotion->discount}}">
                            </div>
                            <div class="mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input type="file" class="form-control  @error('picture') is-invalid @enderror" id="picture" name="picture"> 
                                <img src="{{asset('img/promotions/'. $promotion->picture)}}" alt="{{
                                    $promotion->picture }}"> {{--
                                    kodingan untuk menampilkan images pada form terletak di img dan folder peletakan gambar--}}
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="status"
                                    name="status" @if($promotion->status == 'show')checked @endif>
                                <label class="form-check-label" for="status">Geser Untuk Menampilkan</label>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Simpan </button>
                            </div>
                    </div>
                </div>

                </form>

            </div>
        </div>
    </div>
</div>
    
@endsection
