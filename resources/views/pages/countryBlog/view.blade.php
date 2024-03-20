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
        ul{
            list-style-type: disc !important;
            padding-left: 2rem !important;
            margin-bottom: 20px !important;
        }

        table:not(.note-editable > table) {
            display: flex   ;
            overflow-x: auto;
            white-space: nowrap;
            width: 100% !important;
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
            table:not(.note-editable > table) {

            justify-content: normal !important;
            align-items: normal !important;
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
                            <p>Characters left: <span id="charCount">3500</span></p>


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
    {{-- faq modal --}}
    <div class="modal fade" id="faqmodal" tabindex="-1" aria-labelledby="faqmodal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('faq.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $country->id }}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="faqmodal">Add Faq</h1>

                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body dark-modal">
                        <div class="mb-3">
                            <label class="form-label">Question*</label>
                            <input type="hidden" name="country_id" id="" value="{{$country->id}}">
                            <input type="text" name="question" value="{{ old('question') }}"
                                class="form-control @error('question') is-invalid @enderror" placeholder="">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer*</label>

                            {{-- <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Title"> --}}
                            <textarea class="form-control" name="answer" id="summernote" cols="30" rows="10" placeholder="">{{ old('answer') }}</textarea>

                            @error('answer')
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
    {{-- faq edit modal --}}

        <div class="modal fade" id="faqEditModal" tabindex="-1" role="dialog" aria-labelledby="faqEditModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form method="POST" id="editform" name="editform" enctype="multipart/form-data">
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $country->id }}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="faqmodal">Update Faq</h1>

                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body dark-modal">
                        <div class="mb-3">
                            <label class="form-label">Question*</label>
                            <input type="hidden" name="faq_id" id="faq_id" >
                            <input type="text" name="question" id="editquestion"
                                class="form-control @error('question') is-invalid @enderror" placeholder="">
                            @error('question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Answer*</label>

                            {{-- <input type="text" name="title" value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Title"> --}}
                            <textarea class="form-control" name="answer" id="editanswer" cols="30" rows="10" placeholder="">{{ old('answer') }}</textarea>

                            @error('answer')
                                    <strong class="text-sm text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">


                        <button class="btn btn-dark" id="save-btn" type="submit">Update</button>
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
                    <h3>Update Country</h3>
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

                </div>
                <div class="d-flex justify-content-end gap-2">
                    {{-- <a class="btn btn-dark" href="{{ route('country-blog.index') }}">Back</a> --}}
                    <button class="btn btn-dark">Add Update</button>
                </div>
            </form>
        </div>
    </div>
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h3>Country Content</h3>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class=" breadcrumb     " style="margin-right: 0 !important;">
                <a class="btn btn-dark me-2" href="{{ route('country-blog.index') }}">Back</a>
                <button class="btn btn-outline-info-2x me-2" type="button" data-bs-toggle="modal" data-bs-target="#exampleModalfullscreensm">Add content</button>
                <button class="btn btn-outline-primary-2x me-2" type="button" data-bs-toggle="modal" data-bs-target="#faqmodal">Add Faq</button>
                </div>

            </div>
        </div>
    </div>
</div>
    <div class="card">
        <div class="card-header  d-flex justify-content-between" style="padding-bottom:0 !important; ">
            <h5 style="font-weight: bold;">Content Title</h5>
        </div>
        <div class="card-body">
            <section class="mb-3 border-bottom ">
            @forelse ($country->contents as $content)
                <a class="btn btn-sm btn-outline-dark my-2" href="#{{ $content->title }}">{{ $content->title }}</a>
            @empty
            @endforelse
        </section>

            @forelse ($country->contents as $content)
                <div id="{{ $content->title }}">
                    <h5 class="mt-4 mb-2"style="font-weight: bold;" >Content Description:</h5>
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
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h3 class="faw-Capital">fequently asked questions </h3>
                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header  d-flex justify-content-between" style="padding-bottom:0 !important; ">
            <h5 style="font-weight: bold;"></h5>
        </div>
    <div class="card-body " id="tablerow">
        @forelse ($country->faqs as $faq)
            <div class="">
                <p>{{$faq->question}}</p>
                <p>{{$faq->answer}}</p>
                <div class="row mb-3 ">
                    <div class="col-12 mb-3 ">
                        {{-- <h2>{{ $content->title }}</h2> --}}
                        {{-- <a href="{{ route('faq.edit',$faq->id) }}" class="btn btn-sm btn-outline-dark editfaq" >Edit</a> --}}
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-dark editfaq"  id="editfaq"  data-id="{{ $faq->id}}"  data-bs-toggle="modal" data-bs-target="#faqEditModal" >Edit</a>
                        {{-- <a class="btn btn-sm btn-outline-dark" href="{{route('faq.edit',$faq->id)}}">Edit</a> --}}
                        <a class="btn btn-sm btn-outline-danger" href="#" onclick="setDeleteID('{{ $faq->id }}')"
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
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        var maxChars = 3500;
    // Your jQuery code using $ here
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
          onInit: function() {
            updateCharCount();
          },
          onKeyup: function(e) {
            updateCharCount();
          },
          onImageUpload: function(files) {
            for (var i = 0; i < files.length; i++) {
              insertImage(files[i]);
            }
          },
          onChange: function(contents, $editable) {
            updateCharCount();
          }
        }
      });

      function updateCharCount() {
        var remainingChars = maxChars;
        var htmlContent = $('#summernote').summernote('code');
        var imgTags = htmlContent.match(/<img[^>]*>/g);

        if (imgTags !== null) {
          remainingChars -= imgTags.length * 400;
        }

        remainingChars -= htmlContent.replace(/<img[^>]*>/g, '').replace(/(<([^>]+)>)/gi, '').length;
        $('#charCount').text(remainingChars);

        if (remainingChars < 0) {
          $('#submitButton').prop('disabled', true);
        } else {
          $('#submitButton').prop('disabled', false);
        }
      }

      function insertImage(file) {
        var reader = new FileReader();
        reader.onloadend = function() {
          var img = document.createElement('img');
          img.src = reader.result;
          $('#summernote').summernote('insertNode', img);
          updateCharCount();
        }
        reader.readAsDataURL(file);
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
            document.getElementById('deleteForm').action = "{{ route('faq.destroy', ':id') }}".replace(':id', id);
        }
    </script>
    <script>
$(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
             });

             //edit
        $('body').on('click', '.editfaq', function () {
            var id = $(this).data('id');
            $.ajax({
                url: '/faq/' + id + '/edit',
                type: 'GET',
                success: function (data) {
                    $('#editanswer').val(data.answer);
                    $('#editquestion').val(data.question);
                    $('#faq_id').val(data.id);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
        //edit update
    $("#editform").submit(function(e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        $("#save-btn").attr("disabled", true);
        var data = new FormData($('#editform')[0]);
        var faq_id = $("#faq_id").val();
            $.ajax({

                url: "/faq/" + faq_id,
                type:"POST",
                data:data,
                cache:false,
                processData: false,
                contentType: false,


                success:function(data){
                    $("#save-btn").attr("disabled", false);
                    $("#editform").trigger('reset');
                    $('#faqEditModal').modal('hide');
                    $("#tablerow").load(location.href+' #tablerow');
                }
            });
    });



});



    </script>

@endsection
