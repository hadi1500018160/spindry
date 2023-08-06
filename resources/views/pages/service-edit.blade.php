@extends('app')
@section('title', 'Edit-Service')
@section('page-heading', 'Edit-Service')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="row-12">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            {{-- METHOD [POST] UNTUK KURIR NGAMBIL DARI ROUTER --}}
                            {{-- csrf berfungsi untuk token atau nomer  --}}
                            <form action="{{ url('/service/' . $service->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- --}}
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo</label>
                                    <input type="file" class="form-control  @error('logo') is-invalid @enderror"
                                        id="logo" name="logo">
                                    <img src="{{ asset('img/services/' . $service->logo) }}"
                                        alt="{{ $service->logo }}"> {{--
                                    kodingan untuk menampilkan images pada form terletak di img dan folder peletakan gambar --}}
                                    <div class="invalid-feedback blink">
                                        @error('logo')
                                            <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ $service->title }}">
                                        <div class="invalid-feedback blink">
                                            @error('title')
                                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                            @enderror
                                        </div>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control  @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ $service->price }}">
                                        <div class="invalid-feedback blink">
                                            @error('price')
                                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description" value="{{ $service->description }}">
                                        <div class="invalid-feedback blink">
                                            @error('description')
                                                <i class="fa-solid fa-triangle-exclamation fa-bounce"></i> {{ $message }}
                                            @enderror
                                        </div>
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

@push('scripts')
    <script src="{{ asset('assets/vendors/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('assets/vendors/tinymce/plugins/code/plugin.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '#description'
        });
    </script>
@endpush