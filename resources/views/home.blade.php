@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('status'))
                <div class="alert alert-success" align="center">
                    {{ session('status') }}
                </div>
            @endif
            <form action="/search" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary"> Search </button>
                    </span>
                </div>
            </form>
            <br>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Contacts </strong>
                    <a href="{{route('contacts.create')}}">
                        <button type="button" class="btn btn-info">Create Contact</button>
                    </a>
                </div>

                <div class="panel-body">
                    @foreach($contacts as $contact)
                        <div class="panel-body">
                            <a href="{{ route('contacts.show',$contact->id)}}">
                                <strong>{{ucwords($contact->cname)}}</strong>
                            </a>
                                    @if( $contact->user_id == auth()->user()->id )
                                    <a class="pull-right" href="#" data-toggle="modal" data-target="#deletePost{{ $contact->id }}">
                                        <button type="button" class="btn btn-danger btn-sm">Delete</button>
                                    </a>
                                    <a class="pull-right" href="{{ route('contacts.edit',$contact->id) }}">
                                        <button type="button" class="btn btn-default btn-sm">Edit</button>    
                                    </a>
                                    <div class="modal fade" id="deletePost{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                        <div class="modal-dialog model-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" align="center">
                                                        <strong>Delete Contact</strong>
                
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </h5>
                                                </div>
                
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('contacts.destroy',$contact->id) }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                        <div class="form-group" align="center">
                                                            <h4>Are You Sure You Want To Delete
                                                                <br>
                                                                <strong>{{ ucwords($contact->cname) }}</strong> ?
                                                                <br>
                                                                <button class="btn btn-danger" type="Submit"> Delete </button>
                                                            </h4>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <center> {{ $contacts->links() }} </center>
        </div>
    </div>
</div>
@endsection
