@extends('layouts.app')

@section('title', 'Admin Home')

@section('content')

    <div class="section px-5 border-top border-secondary pt-5" id="admin-dashboard">
        <div class="row px-5 mx-5 g-2">
            <div class="col-4">
                <div class="card rounded-bottom rounded-start rounded-5 text-center" id="card-index">
                    <div class="card-head p-3">
                        <h5 class="card-title"></h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.projects.index') }}" id="to-index-btn">PROJECT INDEX<br><i
                                class="bi bi-list display-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card rounded-bottom rounded-start rounded-5 text-center" id="card-create">
                    <div class="card-head p-3">
                        <h5 class="card-title"></h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{ route('admin.projects.create') }}" id="to-create-btn">CREATE PROJECT<br><i
                                class="bi bi-plus-lg display-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card rounded-bottom rounded-start rounded-5 text-center" id="card-counter">
                    <div class="card-head p-3">
                        <h5 class="card-title"></h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <p>CURRENTLY STORED:<br><span class="fw-bold display-2">{{ $projectCount }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
