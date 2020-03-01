{{--@extends('layouts.index')--}}
{{--@section('model-content')--}}
{{--<div class="card-header">Connection List</div>--}}
    {{--<div class="card-body">--}}
        {{--<table id="table" class="table table-bordered table-hover dataTable"--}}
               {{--role="grid" aria-describedby="example1_info">--}}
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th> Invited User</th>--}}
                {{--<th> To Group</th>--}}
                {{--<th> Status</th>--}}
                {{--<th> Created At</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            {{--<tbody>--}}
            {{--@foreach ($subscriptionList as $model_item)--}}
                {{--<tr id="tr_{{$model_item->id }}">--}}
                    {{--<td>  {{ $model_item->user->name}}   </td>--}}
                    {{--<td>  {{ $model_item->group->name }}   </td>--}}
                    {{--<td>  {{ $model_item->status }}   </td>--}}
                    {{--<td>  {{ $model_item->created_at }}   </td>--}}
                {{--</tr>--}}
            {{--@endforeach--}}
            {{--</tbody>--}}
        {{--</table>--}}

        {{--{{ $subscriptionList->links() }}--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}