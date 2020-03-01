@extends('layouts.double-lists')
@section('model-content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"> My Groups ( connected )</div>
            <div class="card-body">
                <table id="table" class="table table-bordered table-hover dataTable"
                       role="grid" aria-describedby="example1_info">
                    <thead>
                    <tr>
                        <th> Group</th>
                        <th> Type</th>
                        <th> Interest list</th>
                        <th> # of members</th>
                        <th> Date of Join</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($groups as $model_item)
                        <tr id="tr_{{$model_item->id }}">
                            <td>
                                <a href="{{route('subscriptions.show',  $model_item->id)}}">  {{ $model_item->name }} </a>
                            </td>
                            <td>  {{ $model_item->type }}   </td>
                            <td>
                                {{count($model_item->group_interests)}}
                            </td>
                            <td>{{ count($model_item->subscriptions)   }}</td>
                            <td>   {{ $model_item->getCarbonCreatedAt($model_item->created_at) }}     </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $groups->links() }}

            </div>
        </div>
    </div>
@endsection