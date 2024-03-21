@extends('layouts.app')

@section('content')
@include('alert.alert')
     {{-- Breadcrumb --}}
     <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6 ps-0">
                    <h3>Profile</h3>
                </div>
                <div class="col-sm-6 pe-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">
                                <img src="{{ asset('assets/svg/house-chimney.svg') }}" alt=""></a></li>
                        <li class="breadcrumb-item">Profile</li>
                        <li class="breadcrumb-item">View</li>
                        {{-- <li class="breadcrumb-item active"></li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="fw-bold" >Edit Profile</h6>
                    </div>
                    <div class="card-body">

                        <form action=" {{ route('profile.update',$user->id) }} " method="POST">
                            @csrf
                            @method('PUT')

                            <div class="input-group mb-3 @error('name') border border-danger @enderror" id="name-container">
                                <span class="input-group-text" id="basic-addon1" data-field="name">Name <span  style="display: none;" class="dot"  class="text-danger">*</span></span>
                                <input name="name" type="text" class="form-control  " placeholder="" aria-label="Username" aria-describedby="basic-addon1" style="display: none;" value="{{$user->name}}"  >
                                <span class="editable text-muted col-8" style="  margin-top: 9px; margin-left: 11px;">{{$user->name}}</span>


                            </div>
                            <div class="input-group mb-3 @error('email') border border-danger @enderror" id="name-container">
                                <span class="input-group-text" id="basic-addon1" data-field="name">Email<span  style="display: none;" class="dot"  class="text-danger">*</span></span>
                                <input name="email" type="text" class="form-control " placeholder="" aria-label="Username" aria-describedby="basic-addon1" style="display: none;" value="{{$user->email}}" >
                                <span class="editable text-muted col-8" style="  margin-top: 9px; margin-left: 11px;">{{$user->email}}</span>
                            </div>
                            <div class="input-group mb-3 {{(session('notMatch')) ? 'border border-danger': ''}} " id="name-container">
                                <span class="input-group-text" id="basic-addon1" data-field="name"> Password</span>
                                <input name="old_password" type="text" class="form-control " placeholder="" aria-label="Username" aria-describedby="basic-addon1" style="display: none;"  >
                                <span class="null text-muted col-8" style="  margin-top: 9px; margin-left: 11px;">Current Password</span>
                            </div>
                            @if(session('notMatch'))
                            <strong class="text-sm text-danger  " style="font-size: smaller;">{{session('notMatch')}}</strong>
                            @endif
                            <div class="input-group mb-3   @error('password') border border-danger @enderror " id="name-container">
                                <span class="input-group-text" id="basic-addon1" data-field="name">New Password</span>
                                <input name="password" type="text" class="form-control " placeholder="" aria-label="Username" aria-describedby="basic-addon1" style="display: none;"  >
                                <span class="null text-muted col-8" style="  margin-top: 9px; margin-left: 11px;"> New Password</span>
                            </div>
                            @error('password')
                                <span class="text text-danger"> {{$message}} </span>
                            @enderror
                            <div class="input-group mb-3 {{(session('conf_notMatch')) ? 'border border-danger': ''}} @error('password_confirmation') border border-danger @enderror" id="name-container">
                                <span class="input-group-text" id="basic-addon1" data-field="name">Confirm Password</span>
                                <input name="password_confirmation" type="text" class="form-control  " placeholder="" aria-label="Username" aria-describedby="basic-addon1" style="display: none;"  >
                                <span class="null text-muted col-8" style="  margin-top: 9px; margin-left: 11px;">Confirm Password</span>
                            </div>

                            <div class=" mb-3" >
                                <button style="display: none;" id="submit-btn"   class="btn   float-end btn-info">Update</button>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
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
<script>
document.addEventListener('click', function(event) {
    // Check if the clicked element is a span inside the name-container
    if (event.target.matches('#name-container span.editable')) {
        activateEditMode(event.target);
    }
    if (event.target.matches('#name-container span.null')) {
        activateEditModeNull(event.target);
    }
});

function activateEditMode(span) {
    var container = span.parentElement;
    var input = container.querySelector('input');
    var button = document.getElementById('submit-btn');
    var text = span;

    // Switch to edit mode
    text.style.display = 'none';
    input.style.display = 'block';
    button.style.display = 'block';
    input.value = text.innerText.trim(); // Update input value with text content
    input.focus();
}
function activateEditModeNull(span) {
    var container = span.parentElement;
    var input = container.querySelector('input');
    var button = document.getElementById('submit-btn');
    var text = span;
    if (!span.getAttribute('data-field')) {
        // If static data, clear input value
        input.value = '';
    }
    // Switch to edit mode
    text.style.display = 'none';
    input.style.display = 'block';
    button.style.display = 'block';
    input.value = ''; // Update input value with text content
    input.focus();
}

</script>

@endsection
