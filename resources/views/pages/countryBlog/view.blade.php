@extends('layouts.app')
@section('style')
{{-- summernote --}}
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
 <style>
     img:not(.note-editable > p > img) {
            width: 100% ;
            display: flex !important;
            margin: auto !important;
        }
        .note-editable > p > img{
            display: flex;
            margin: auto;
        }
        iframe {
            display: block;
            margin: auto;
            max-width: 100%;
            max-height: 100%;
        }


        table:not(.note-editable > table) {
            display: flex   ;
            overflow-x: auto;
            white-space: nowrap;
            width: 100%;
            border-collapse: collapse;
            justify-content: center;
            align-items: center;
        }

    table th,
    table td {
        padding: 8px;
        border: 1px solid #ccc;
        word-wrap: break-word;
    }


        @media (max-width: 576px) {
            .table {
                font-size: 8px; /* Adjust font size for smaller screens */
            }
            img:not(.note-editable > p > img) {
            width: 100% !important;
            }
            iframe {
                width: 95%;
                height: 100%;
            }
            .note-editable img {
                /* Add your CSS properties for the img element here */

            }
           }
        @media (max-width: 767px) {
            .table {
                font-size: 10px; /* Adjust font size for smaller screens */
            }

            img:not(.note-editable > p > img) {
                width: 100% !important;
            }
            iframe {
                width: 95%;
                height: 100%;
            }
        }
        @media (min-width: 768px) and (max-width: 992px) {
            img:not(.note-editable > p > img) {
                width: 100% !important;
            }
        }

</style>
{{-- summernote --}}

@endsection

@section('content')
<div class="modal fade" id="tooltipmodal" tabindex="-1" role="dialog" aria-labelledby="tooltipmodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="deleteForm" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="deleteID" id="deleteID" class="deleteID">

                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-3">Are you sure you want to permanently remove this item?</h5>
                    <p class="f-m-light mt-1">
                        This action will permanently delete the selected item along with all associated content. This
                        action cannot be undone. Are you sure you want to proceed?
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-dark" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
    @include('alert.alert')

    <!-- Full screen below sm modal-->
    <div class="modal fade" id="exampleModalfullscreensm" tabindex="-1" aria-labelledby="smModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                            <textarea class="form-control" name="content" id="summernote" cols="30" rows="10" placeholder="Content">{{ old('content') }}</textarea>

                            @error('content')
                                    <strong class="text-sm text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-dark" id="submitButton" type="submit">Add</button>
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
                    <h3>Country Content</h3>
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
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country Name*</label>
                            <input type="text" name="name" value="{{ $country->name }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Country Title*</label>
                            <input type="text" name="title" value="{{ $country->title }}"
                                class="form-control @error('country_title') is-invalid @enderror" placeholder="Title">
                            @error('country_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"> Country Description*</label>
                            <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Description">{{ $country->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Content Seo Title</label>
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
                            <label class="form-label">Content Seo Description</label>
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
                            <label class="form-label">Content Seo Tags</label>
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
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6">
                               <div class="row">
                                    <div class=" mb-2">
                                        <label class="form-label">Country Thumbnail* <span
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
                                <div class="row">
                                    <div class="col-2">
                                        <img src="{{ asset('uploads/country/' . $country->thumbnail) }}" width="100%"
                                        alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="">
                                       <label class="form-label">Country Banner* <span
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
                                 <div class="row">
                                   <div class="col-6 mt-2">
                                       <img src="{{ asset('uploads/country/' . $country->banner) }}" width="100%"
                                           alt="">
                                   </div>
                                 </div>
                            </div>

                        </div>
                    </div>
                    {{-- <div class="col-lg-6 col-md-6 ">
                        <div class="mb-3">
                            <div class="row">
                                <div class="row">
                                    <div class=" mb-2">
                                         <label class="form-label">Country Thumbnail* <span
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
                                <div class="row">
                                    <div class="col-2">
                                        <img src="{{ asset('uploads/country/' . $country->thumbnail) }}" width="100%"
                                        alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-3">
                            <div class="row ">
                              <div class="row">
                                 <div class="col-10">
                                    <label class="form-label">Country Banner* <span
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
                              <div class="row">
                                <div class="col-6 mt-2">
                                    <img src="{{ asset('uploads/country/' . $country->banner) }}" width="100%"
                                        alt="">
                                </div>
                              </div>

                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="d-flex justify-content-end gap-2">
                    {{-- <a class="btn btn-dark" href="{{ route('country-blog.index') }}">Back</a> --}}
                    <button class="btn btn-dark">Add Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header  d-flex justify-content-between" style="padding-bottom:0 !important; ">
            <h4>Content Title</h4>
            <div>
                <a class="btn btn-dark" href="{{ route('country-blog.index') }}">Back</a>
                <button class="btn btn-outline-info-2x" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModalfullscreensm">Add content</button>
            </div>
        </div>
        <div class="card-body">
            <section class="mb-3 ">
            @forelse ($country->contents as $content)
                <a class="btn btn-sm btn-outline-dark my-2" href="#{{ $content->title }}">{{ $content->title }}</a>
            @empty
            @endforelse
        </section>

            @forelse ($country->contents as $content)
                <div id="{{ $content->title }}">
                    <h4 class="mt-4 mb-2" >Content Description</h4>
                    <div class="row mb-3">
                        <div class="col-12">
                            <p>{!! $content->content !!}</p>
                        </div>
                        <div class="col-12 mb-3 ">
                            {{-- <h2>{{ $content->title }}</h2> --}}
                            <a class="btn btn-sm btn-outline-dark" href="{{route('blog-item.edit',$content->id)}}">Edit</a>
                            <a class="btn btn-sm btn-outline-danger" href="#" onclick="setDeleteID('{{ $content->id }}')"
                                data-bs-toggle="modal" data-bs-target="#tooltipmodal">Delete</a>
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
{{-- summernote --}}
<script>
    $('#summernote').summernote({
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ],
      callbacks: {
        onKeyup: function(e) {
          var content = $(this).summernote('code');
          var wordCount = content.replace(/<(?:.|\n)*?>/gm, '').split(/\s+/).length;
          $('#wordCount').text(wordCount + " words");

          // Limiting word count to 1000
          if (wordCount > 10) {
            $(this).summernote('code', content.split(/\s+/).slice(0, 1000).join(' '));
            $('#wordCount').text("1000 words (maximum)");
            $('#submitButton').prop('disabled', true);
          } else {
            $('#submitButton').prop('disabled', false);
          }
        }
      }
    });
  </script>



{{-- summernote --}}
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
    <script>
        function setDeleteID(id) {
            document.getElementById('deleteID').value = id;
            // Set the form action dynamically
            document.getElementById('deleteForm').action = "{{ route('blog-item.destroy', ':id') }}".replace(':id', id);
        }
    </script>
@endsection
