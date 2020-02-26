@extends('layouts.index')
@section('model-content')
    <div class="card-header">User List</div>
    <div class="card-body">
        <table id="table" class="table table-bordered table-hover dataTable"
               role="grid" aria-describedby="example1_info">
            <thead>
            <tr>
                <th> Name</th>
                <th> Email</th>
                <th> Created At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $model_item)
                <tr id="tr_{{$model_item->id }}">
                    <td>  {{ $model_item->name }}   </td>
                    <td>  {{ $model_item->email }}   </td>
                    <td>  {{ $model_item->created_at }}   </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        Count: {{ $users->count() }} of {{ $users->total() }}
        {{ $users->links() }}
    </div>
    </div>
@endsection
