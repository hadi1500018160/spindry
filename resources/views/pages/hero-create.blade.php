@extends('app')

@section('title', 'Create-Hero')
@section('page-heading', 'Creat-Hero')
@push('style')
<style>
    .blink {
        animation: blinker 1.5s linear infinite;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
</style>
@endpush


@section('content')
    <div class="page-content">
        <div class="row">
            <div class="row-12">
                <div class="col-6">
                    {{-- @if ($errors->any()) 
                    @foreach ($errors->all() as $item)
                    <div class="alert alert-danger mb-2" role="alert">
                        {{$item}}
                      </div>
                    @endforeach
                    @endif --}}
                    <div class="card">
                        <div class="card-body">
                            {{-- METHOD [POST] UNTUK KURIR NGAMBIL DARI ROUTER --}}
                            {{-- csrf berfungsi untuk token atau nomer  --}}
                        {{--  value="{{old('title')}} untuk mengatur tulisn--}}
                        {{--@error('title') {{$message}}
                                         @enderror  berfungsi untuk pesan error pada table bawah--}}

                            <form action="{{ url('/hero') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"  id="title" name="title" value="{{old('title')}}">
                                     <div  class="invalid-feedback blink">
                                        @error('title') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                                         @enderror
                                      </div>
                                </div>

                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control  @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle"  value="{{old('subtitle')}}">
                                    <div  class="invalid-feedback blink">
                                    @error('subtitle') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                                    @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="background" class="form-label">Background</label>
                                    <input type="file" class="form-control  @error('background') is-invalid @enderror" id="background" name="background" value="{{old('background')}}">
                                    <div  class="invalid-feedback blink">
                                    @error('background') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                                    @enderror
                                   </div>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status"
                                        name="status">
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
