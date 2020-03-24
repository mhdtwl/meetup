<?php

namespace App\Http\Controllers\ApiV1;

use App\User;
use App\Traits\SearchableTrait;
use Illuminate\Http\Request;

/**
 * Class UserRestController
 * @package App\Http\Controllers\ApiV1
 */
class UserRestController extends RestController
{
    use SearchableTrait;
    /**
     * Returned array 's kind of drawable items into table to use them via VueJS component.
     * @param Request $request
     * @return array
     */
    public function getSearchableUserTable(Request $request)
    {
        $objectQuery = User::select('id', 'name', 'email');
        $columnsArray = [
            "dbSelectColumns" => ['id', 'name', 'email'], //database fields
            "searchColumns" => ['name', 'email'], // dataTable columns
            "dataTableColumns" => ['name', 'email'],
        ];
        return $this->drawSearchableTable($request, $objectQuery, $columnsArray);
    }
}
