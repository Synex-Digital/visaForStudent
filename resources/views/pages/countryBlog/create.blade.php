@extends('layouts.app')

@section('content')
    @include('alert.alert')

    {{-- Breadcrumb --}}
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Add Country</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <img src="{{ asset('assets/svg/house-chimney.svg') }}" alt=""></a></li>
                        <li class="breadcrumb-item active">Country</li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a class="btn btn-sm btn-dark" href="{{ route('country-blog.index') }}">Country Content</a>
        </div>
        <div class="card-body">
            <form action="{{ route('country-blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label class="form-label">Name*</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title*</label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description*</label>
                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Thumbnail* <span
                                    class="badge badge-light text-dark tag-pills-sm-mb">w:640 / h:780</span></label>
                            <input type="file" name="thumbnail"
                                class="form-control @error('thumbnail') is-invalid @enderror">
                            @error('thumbnail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Banner* <span
                                    class="badge badge-light text-dark tag-pills-sm-mb">w:2050 / h:605</span></label>
                            <input type="file" name="banner" class="form-control @error('banner') is-invalid @enderror">
                            @error('banner')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">Seo Title</label>
                            <input type="text" name="seo_title"
                                class="form-control @error('seo_title') is-invalid @enderror" placeholder="Title">
                            @error('seo_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Seo Description</label>
                            <input type="text" name="seo_description"
                                class="form-control @error('seo_description') is-invalid @enderror"
                                placeholder="Descripton">
                            @error('seo_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Seo Tags</label>
                            <input type="text" name="seo_tags"
                                class="form-control @error('seo_tags') is-invalid @enderror" placeholder="Tags">
                            @error('seo_tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <button class="btn btn-primary block">Add Country</button>
            </form>
        </div>
    </div>
@endsection



@section('script')
    @if (session('succ'))
        <script>
            const toastLiveExample = document.getElementById("liveToast1");
            if (toastLiveExample) {
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            }
        </script>
    @endif
    @if (session('err'))
        <script>
            const toastLiveExample = document.getElementById("liveToast1");
            if (toastLiveExample) {
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            }
        </script>
    @endif
@endsection
