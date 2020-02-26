@extends('layouts.index')
@section('model-content')
<div class="card-header">Invite my people to [ {{$group->name}} ] group ! </div>
    <div class="card-body">
        <table id="table" class="table table-bordered table-hover dataTable"
               role="grid" aria-describedby="example1_info">
            <thead>
            <tr>
                <th> Name</th>
                <th> Email</th>
                <th> Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $model_item)
                <tr id="tr_{{$model_item->id }}">
                    <td>  {{ $model_item->name }}   </td>
                    <td>  {{ $model_item->email }}   </td>
                    <td>  <a href="{{route('group.invite',  [  $group->id,   $model_item->id])}}">Invite to {{$group->name}}</a>  </td>
                    {{--."/".$model_item->id}}--}}
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
        <div class="float-right">
            <a href="{{route('subscriptions.index')}}" class="btn bg-default">
                Go back!.
            </a>
        </div>
    </div>
</div>
@endsection