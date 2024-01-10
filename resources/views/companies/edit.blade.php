


@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    {{-- <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">

            </div>
        </div>
    </div> --}}


    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error  }}</li>

                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form role='form' method="POST" action={{ route('companies.update',$companies->id) }}
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Company</p>
                            <button class="btn btn-primary btn-sm ms-auto">Save</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-uppercase text-sm">COMPANY INFORMATION</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name</label>
                                    <input class="form-control" type="text" value="{{old ('name',$companies->name)}}" name="name">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email address</label>
                                    <input class="form-control" type="email" value="{{old ('username',$companies->email)}}" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Website</label>
                                    <input class="form-control" type="website" value="{{old ('username',$companies->website)}}" name="website">
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Logo</label>

                                        <input class="form-control" type="file" name="logo_pic">
                                    @if ($companies->document_path)
                                    <img src="{{ asset('storage/'.$companies->document_path) }}" class='img-fluid me-3' alt='image'>

                                    @else
                                        <p>No picture uploaded</p>
                                    @endif

                                </div>
                            </div>

                        </div>

                    </div>
                </form>
                </div>
            </div>

        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
