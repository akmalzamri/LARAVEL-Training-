@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">

                </div>

                <div class="card-body">

                    <a href="{{$task->id}}/view-pdf" class="btn btn-warning">Save as PDF</a>

                    <form action="/tasks/create" method="post">
                            @csrf   
                            
                            <div class="form-group">
                                    <label for="" class="col-lg-12 control-label">Name</label>
                            <input name="name" type="text" class="form-control" value="{{isset($task)? $task->name:''}}">
                            </div>
                            
                            <div class="form-group">
                                    <label for="" class="col-lg-12 control-label">Content</label>
                                    <textarea  name="content" id="" cols="30" rows="10" class="form-control" value="">{{isset($task)? $task->content:''}}</textarea>
                            </div>

                            <div class="form-group">
                                    <label for="" class="col-lg-12 control-label">Owner</label>
                                    <input name="name" type="text" class="form-control value="{{isset($task)? $task->user_id:''}}"">
                            </div>
                            
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>




@endsection

