@extends('layouts.app')

@section('content')
@include('alert.alert')
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
                        <li class="breadcrumb-item active">Country</li>
                        {{-- <li class="breadcrumb-item active">Breadcrumb</li> --}}
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a class="btn btn-sm btn-primary" href="{{ route('country-blog.create') }}">Create Country</a>
        </div>
        <div class="card-body">
            <table class="table table-dashed">
                <thead>
                    <tr>
                        <th scope="col">Id </th>
                        <th scope="col">Classname</th>
                        <th scope="col">Thumbnail/Banner</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($countries as $key =>  $country)
                    <tr>
                        <th scope="row">{{ $key+1 }}</th>
                        <td>{{ $country->name }}</td>
                        <td>
                            <img src="{{ asset('uploads/country/'.$country->thumbnail ) }}" width="40" alt="">
                            <img src="{{ asset('uploads/country/'.$country->banner) }}" width="40" alt="">
                        </td>
                        <td>{{ $country->created_at->format('M-d-y : h:i A') }}</td>
                        <td>
                            <ul class="action">
                                <li class="edit"> <a href="{{ route('country-blog.show', $country->id) }}"><img src="{{ asset('assets/svg/eye.svg') }}"></a></li>
                                <li class="delete"><a href="#"><img src="{{ asset('assets/svg/trash.svg') }}"></a></li>
                            </ul>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
            <div class="mt-3 ">
                {{ $countries->links('pagination::bootstrap-4') }}
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
