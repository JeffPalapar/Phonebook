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
                    <i class="pull-right">
                        <a href="{{route('contacts.create')}}"> Create Contact </a>
                    </i>
                </div>

                <div class="panel-body">
                    @foreach($contacts as $contact)
                        <div class="panel-body">
                            <a href="{{ route('contacts.show',$contact->id)}}">
                                <strong>{{ucwords($contact->cname)}}</strong>
                            </a>
                            <i class="pull-right">
                                Created: {{ $contact->created_at }}
                            </i>
                        </div>
                    @endforeach
                </div>
            </div>
            <center> {{ $contacts->links() }} </center>
        </div>
    </div>
</div>
@endsection
