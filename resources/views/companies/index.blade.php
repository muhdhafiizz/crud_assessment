
@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="alert alert-light" role="alert">
                This feature is available in <strong>Argon Dashboard 2 Pro Laravel</strong>. Check it
                <strong>
                    <a href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank">
                        here
                    </a>
                </strong>
            </div>
            @if (session()->has ('status'))
                <div class="alert alert-light" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header pb-0">

                    <div class="d-flex align-items-center">
                        <a href="{{ route('companies.create') }}" class="btn btn-warning btn-sm">Add New Company</a>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Website</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center px-3 py-1">
                                                <div>
                                                    @if ($item->document_path)
                                                        <img src="{{ asset('storage/'.$item->document_path) }}" class="avatar me-3" alt="image">
                                                    @else
                                                        <img src="{{ asset('./img/team-1.jpg') }}" class="avatar me-3" alt="image">
                                                    @endif
                                                </div>
                                                <div>
                                                    <p class="text-sm font-weight-bold mb-0">{{ $item->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $item->email }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $item->website }}</p>
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('companies.show', $item->id) }}"><button class="btn btn-warning">Show</button></a> --}}
                                            <a href="{{ route('companies.edit', $item->id) }}"><button class="btn btn-success">Edit</button></a>

                                            @if (Auth::user()->id != $item->id)
                                                <form method="POST" action="{{ route('companies.destroy', $item->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-primary">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

