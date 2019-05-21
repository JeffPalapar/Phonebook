@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Update Contact </strong>
                </div>
    
                <div class="panel-body">
                    <form method="post" action="{{route('contacts.update', $contact->id)}}">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="cname" id="cname" placeholder="Contact Name" class="form-control" value="{{$contact->cname}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="cnumber" placeholder="Contact Number" value="{{$contact->cnumber}}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="caddress" placeholder="Contact Address" value="{{$contact->caddress}}" required>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit"> Update </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection