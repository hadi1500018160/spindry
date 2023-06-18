@extends('app')
@section('title', 'edit-hero')
@section('page-heading', 'edit-hero')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="row-12">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            {{-- METHOD [POST] UNTUK KURIR NGAMBIL DARI ROUTER --}}
                            {{-- csrf berfungsi untuk token atau nomer  --}}
                            <form action="{{ url('/hero/'.$hero->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- --}}
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"  id="title" name="title" value="{{$hero->title}}">
                                    <div  class="invalid-feedback blink">
                                        @error('title') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                                         @enderror
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <label for="subtitle" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control  @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{$hero->subtitle}}">
                                    <div  class="invalid-feedback blink">
                                        @error('title') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                                         @enderror
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <label for="background" class="form-label">Background</label>
                                    <input type="file" class="form-control  @error('background') is-invalid @enderror" id="background" name="background"> 
                                    <img src="{{asset('img/heros/'. $hero->background)}}" alt="{{
                                        $hero->background }}">
                                        <div  class="invalid-feedback blink">
                                            @error('title') <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{$message}}
                                             @enderror
                                          </div>
                                        {{--
                                        kodingan untuk menampilkan images pada form--}}
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" id="status"
                                        name="status" @if($hero->status == 'show')checked @endif>
                                    <label class="form-check-label" for="status">Gesr Untuk Menampilkan</label>
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
