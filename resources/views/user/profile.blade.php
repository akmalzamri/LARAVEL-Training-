@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{session('status')}}
                            </div>

                        @elseif ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form action="/user/profile" method="POST" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="" class="col-lg-12">Name</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" name="name" value="{{$user->name}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-lg-12">Email</label>
                                <div class="col-lg-12">
                                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-lg-12">Profile Photo</label>

                                <div class="col-lg-12">
                                </div>

                                <div class="col-lg-12" style="display: flex; flex-direction: row; justify-content: space-between">
                                    <img src="/{{$user->photo_path}}" alt="" style="width: 50px; height: 50px; border-radius: 50% ">

                                    <input type="file" name="photo">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-lg-12">Password</label>
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" name="password" placeholder="&#9679&#9679&#9679&#9679&#9679">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-lg-12">Confirm Password</label>
                                <div class="col-lg-12">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="&#9679&#9679&#9679&#9679&#9679">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
