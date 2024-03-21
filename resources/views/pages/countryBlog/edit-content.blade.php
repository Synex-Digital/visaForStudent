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
@endsection
@section('content')
<div class="">
    <div class="row ">
        <div class="col-lg-12 ">
            <div class="container-fluid">
                <div class="page-title">
                    <div class="row">
                        <div class="col-sm-6 ps-0">
                            <h3>Update Country Content</h3>
                        </div>
                        <div class="col-sm-6 pe-0">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                        <img src="{{ asset('assets/svg/house-chimney.svg') }}" alt=""></a></li>
                                <li class="breadcrumb-item">Country</li>
                                <li class="breadcrumb-item">View</li>
                                <li class="breadcrumb-item active">{{$countryBlog->title}}</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">

                <div class="card-body">
                    <form action="{{ route('blog-item.update',$countryBlog->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <input type="hidden" name="id" value="{{ $country->id }}"> --}}

                        <div class="">
                            <div class="mb-3">
                                <label class="form-label fs-6">Title*</label>

                                <input type="text" name="title"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{$countryBlog->title}}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fs-6">Content*</label>
                                {{-- <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Title"> --}}
                                <textarea class="form-control" name="content" id="summernote" cols="70" rows="50" > {{$countryBlog->content}}</textarea>
                                <p>Characters left: <span id="charCount">3500</span></p>
                                @error('content')
                                    <strong class="text-sm text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">


                            <button class="btn btn-dark" id="submitButton" type="submit">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('summernote_script')
{{-- summernote --}}
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        var maxChars = 3500;
    // Your jQuery code using $ here
    $('#summernote').summernote({
    tabsize: 2,
    height: 500,
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

@endsection
