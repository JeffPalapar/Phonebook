@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Create Contact </strong>
                </div>

                <div class="panel-body">
                    <form method="post" action="{{route('contacts.store')}}">
                    {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="cname" placeholder="Contact Name" class="form-control" value="{{old('cname')}}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="cnumber" placeholder="Contact Number" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="caddress" placeholder="Address" class="form-control" required>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="Submit"> Create </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection