@extends('layouts.app')

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
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $country->name }}</td>
                            <td>
                                <img src="{{ asset('uploads/country/' . $country->thumbnail) }}" width="40"
                                    alt="">
                                <img src="{{ asset('uploads/country/' . $country->banner) }}" width="40" alt="">
                            </td>
                            <td>{{ $country->created_at->format('M-d-y : h:i A') }}</td>
                            <td>
                                <ul class="action">
                                    <li class="edit">
                                        <a href="{{ route('country-blog.show', $country->id) }}">
                                            <img src="{{ asset('assets/svg/eye.svg') }}"></a>
                                    </li>
                                    <li class="delete">
                                        <a href="#" onclick="setDeleteID('{{ $country->id }}')"
                                            data-bs-toggle="modal" data-bs-target="#tooltipmodal">
                                            <img src="{{ asset('assets/svg/trash.svg') }}"></a>
                                    </li>
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
    <script>
        function setDeleteID(id) {
            document.getElementById('deleteID').value = id;
            // Set the form action dynamically
            document.getElementById('deleteForm').action = "{{ route('country-blog.destroy', ':id') }}".replace(':id', id);
        }
    </script>
@endsection
