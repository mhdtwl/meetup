<?php

namespace App\Http\Controllers\ApiV1;

use App\Http\Controllers\Controller;
use App\Traits\SearchableTrait;
use App\User;
use Illuminate\Http\Request;

class UserService extends Controller
{
    use SearchableTrait;

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
