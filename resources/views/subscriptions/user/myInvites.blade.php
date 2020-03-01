@extends('layouts.index')
@section('model-content')
    <div class="card-header">My Invited users to groups</div>
    <div class="card-body">
        <table id="table" class="table table-bordered table-hover dataTable"
               role="grid" aria-describedby="example1_info">
            <thead>
            <tr>
                <th> Invited User </th>
                <th> To Group</th>
                <th> Status</th>
                <th> Date of Invitation</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($subscriptions as $model_item)
                <tr id="tr_{{$model_item->id }}">
                    <td>
                        @if($model_item->user->id === Auth::id())
                        ( You )
                        @else
                        {{ $model_item->user->name}}
                        @endif
                    </td>
                    <td>  {{ $model_item->group->name }}   </td>
                    <td>  {{ $model_item->status }}     </td>
                    <td>  {{ $model_item->getCarbonCreatedAt($model_item->created_at) }}    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $subscriptions->links() }}
    </div>
    </div>
@endsection