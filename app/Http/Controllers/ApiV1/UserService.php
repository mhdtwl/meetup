<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Traits\SearchableTrait;
use App\User;
use Illuminate\Http\Request;

class UserService extends Controller
{
    use SearchableTrait;
//    /**
//     * @param Request $request
//     * @return User[]|\Illuminate\Database\Eloquent\Collection
//     */
////    public function userAll(Request $request){
////        return User::all();
////        //return response()->json( , 200);
////    }

    public function getSearchableUserTable(Request $request)
    {
        $objectQuery = User::select('id', 'name', 'email');
        $columnsArray = [
            "dbSelectColumns" => [ 'id', 'name', 'email'], //database fields
            "searchColumns" => [ 'name', 'email'] , // dataTable columns
            "dataTableColumns" => [ 'name', 'email'] ,
        ];
        return  $this->drawSearchableTable($request, $objectQuery, $columnsArray);
    }
}










//
//
//    public function getObjectDataToDrawTable2(Request $request, $objectQuery, $columnsArray = null )
//    {
//        $searchColumns = collect($columnsArray['searchColumns']);
//        $columns = $columnsArray['dataTableColumns'];
//
//        $length = $request->input('length');
//        $searchValue = $request->input('search');
//
//        $column = 0;
//        if($request->input('column')){
//            $column = $request->input('column'); //Index
//        }
//        $dir = 'asc';
//        if($request->input('column')){
//            $dir = $request->input('dir');
//        }
//        $query = $objectQuery->orderBy($columns[$column], $dir);
//
//        if ($searchValue && count($searchColumns) > 0) {
//            $query->where(function ($query) use ($searchValue, $searchColumns) {
//                $query = $query->where($searchColumns[0], 'like', '%' . $searchValue . '%');
//                $filteredColumns = $searchColumns->except([$searchColumns[0]]);
//                foreach ($filteredColumns as $column) {
//                    $query->orWhere($column, 'like', '%' . $searchValue . '%');
//                }
//            });
//        }
//
//        $items = $query->paginate($length);
//       // dd($items);
//        return ['data' => $items, 'draw' => $request->input('draw')];
//    }
