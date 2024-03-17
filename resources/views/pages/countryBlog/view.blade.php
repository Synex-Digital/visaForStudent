@extends('layouts.app')

@section('content')
    @include('alert.alert')

    <!-- Full screen below sm modal-->
    <div class="modal fade" id="exampleModalfullscreensm" tabindex="-1" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <form action="{{ route('blog-item.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $country->id }}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="smModalLabel">Add country Content</h1>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body dark-modal">
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
                            <label class="form-label">Content*</label>
                            {{-- <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Title"> --}}
                            <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Content">{{ old('content') }}</textarea>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-dark" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Breadcrumb --}}
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Country</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <img src="{{ asset('assets/svg/house-chimney.svg') }}" alt=""></a></li>
                        <li class="breadcrumb-item">Country</li>
                        <li class="breadcrumb-item">View</li>
                        <li class="breadcrumb-item active">{{ $country->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('country-blog.update', $country->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label class="form-label">Name*</label>
                            <input type="text" name="name" value="{{ $country->name }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title*</label>
                            <input type="text" name="title" value="{{ $country->title }}"
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
                                placeholder="Description">{{ $country->description }}</textarea>
                            @error('description')
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
                                class="form-control @error('seo_title') is-invalid @enderror"
                                value="{{ $country->seo_title }}" placeholder="Title">
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
                                value="{{ $country->seo_description }}" placeholder="Descripton">
                            @error('seo_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Seo Tags</label>
                            <input type="text" name="seo_tags"
                                class="form-control @error('seo_tags') is-invalid @enderror"
                                value="{{ $country->seo_tags }}" placeholder="Tags">
                            @error('seo_tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ asset('uploads/country/' . $country->thumbnail) }}" width="100%"
                                        alt="">
                                </div>
                                <div class="col-10">
                                    <label class="form-label">Thumbnail* <span
                                            class="badge badge-light text-dark tag-pills-sm-mb">w:640 /
                                            h:780</span></label>
                                    <input type="file" name="thumbnail"
                                        class="form-control @error('thumbnail') is-invalid @enderror">
                                    @error('thumbnail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ asset('uploads/country/' . $country->banner) }}" width="100%"
                                        alt="">
                                </div>
                                <div class="col-10">
                                    <label class="form-label">Banner* <span
                                            class="badge badge-light text-dark tag-pills-sm-mb">w:2050 /
                                            h:605</span></label>
                                    <input type="file" name="banner"
                                        class="form-control @error('banner') is-invalid @enderror">
                                    @error('banner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    {{-- <a class="btn btn-dark" href="{{ route('country-blog.index') }}">Back</a> --}}
                    <button class="btn btn-dark">Add Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4>Content</h4>
            <div>
                <a class="btn btn-dark" href="{{ route('country-blog.index') }}">Back</a>
                <button class="btn btn-outline-info-2x" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModalfullscreensm">Add content</button>
            </div>
        </div>
        <div class="card-body">
            <section class="mb-3">
            @forelse ($country->contents as $content)
                <a class="btn btn-sm btn-outline-dark" href="#{{ $content->title }}">{{ $content->title }}</a>
            @empty
            @endforelse
        </section>
            @forelse ($country->contents as $content)
                <div id="{{ $content->title }}">
                    <div class="row mb-3">
                        <div class="col-12">
                            <p>{!! $content->content !!}</p>
                        </div>
                        <div class="col-12 mb-3 d-flex justify-content-between">
                            {{-- <h2>{{ $content->title }}</h2> --}}
                            <a class="btn btn-sm btn-outline-dark" href="#">Edit</a>
                        </div>
                    </div>
                </div>
                <hr>
            @empty
                No Data found
            @endforelse

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
