@extends('layouts.index')
@section('model-content')
    <div class="card-header">
        <h2 class="box-title"><strong>Create</strong> new invitation !! </h2>
    </div>
    <div class="card-body">
        <h4> You are going to invite <b>{{$user->name}}</b> <br/> to  <b> {{$group->name}} </b> group,<br/> are you sure?</h4>
        <div class="container">
            <div class=" box box-primary ">
                <div class="box-header  with-border  ">
                </div>
                <div class="box-body bg-white">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="btn-group">
                                <form method="post" action="{{route('subscriptions.store')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="groupId" value="{{$group->id}}"/>
                                    <input type="hidden" name="userId" value="{{$user->id}}"/>
                                    <button class="btn bg-primary">
                                        Yes, Invite!
                                    </button>
                                </form>
                                <a href="{{route('subscriptions.show', $group->id)}}" class="btn bg-default">
                                    No, go back!.
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
