@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="text-center" >Welcome to Dashboard, {{Auth::user()->name}}</h3>
            </div>
        </div>
    </div>
</div>
@endsection

