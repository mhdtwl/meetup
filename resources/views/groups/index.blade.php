@extends('layouts.index')
@section('model-content')
    <div class="card-header">Group List</div>
    <div class="card-body">
        <table id="table" class="table table-bordered table-hover dataTable"
               role="grid" aria-describedby="example1_info">
            <thead>
            <tr>
                <th> Name</th>
                <th> Type</th>
                <th> Interests</th>
                <th> Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($groups as $model_item)
                <tr  id="tr_{{$model_item->id }}">
                    <td>  {{ $model_item->name }}   </td>
                    <td>  {{ $model_item->type }}   </td>
                    <td >
                        @foreach($model_item->group_interests as $item)
                           <span class="badge badge-{{$colors[array_rand($colors)] }}">  <h6> {{$item->interest->name}} </h6></span>
                        @endforeach
                    </td>
                    <td>  {{ $model_item->getCarbonCreatedAt($model_item->created_at) }}   </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        Count: {{ $groups->count() }} of {{ $groups->total() }}
        {{ $groups->links() }}
    </div>
    </div>
@endsection
