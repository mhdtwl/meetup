<?php

namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait SearchableTrait
{
    private function getRequestColumnAndDirection($request, $columns)
    {
        $orderIndex = $request->input('column');
        $orderColumn = array_key_exists($orderIndex, $columns) ? $columns[$orderIndex] : $columns[0];
        //-- validation dir
        $dirInput = $request->input('dir') ?? 'asc';// asc default
        $orderDirection = $dirInput;
        //dd(['Column' => $orderColumn, 'Direction' => $orderDirection]);
        return ['Column' => $orderColumn, 'Direction' => $orderDirection];
    }
    private function getDataObjectFiltered($query, $searchValue, $searchColumns)
    {

        if ($searchValue && count($searchColumns) > 0) {
            $query->where(function ($query) use ($searchValue, $searchColumns) {
                $query = $query->where($searchColumns[0], 'like', '%' . $searchValue . '%');
                $filteredColumns = $searchColumns->except([$searchColumns[0]]);
                foreach ($filteredColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $searchValue . '%');
                }
            });
        }
        return $query;
    }

    public function getObjectSearchableData(Request $request, $objectQuery, $columnsArray = null)
    {
        $searchColumns = collect($columnsArray['searchColumns']);
        $columns = $columnsArray['dataTableColumns'];
        // validation

        Validator::make($request->all(),[//$request->validate([ $request->all(),
            'draw' => 'numeric',
            'length' => 'numeric',
            'search' => 'nullable|string',
            'column' => [
                'numeric',
                function ($input, $value) use ($columns) {
                    return $value < count($columns);
                }
            ],
            'dir' => 'string',
        ]);

        // get inputs
        $length = $request->input('length');
        $searchValue = $request->input('search');
        $order = $this->getRequestColumnAndDirection($request, $columns);
        // order
        $objectQueryOrdered = $objectQuery->orderBy($order['Column'], $order['Direction']);
        // filter
        $objectQueryFiltered = $this->getDataObjectFiltered($objectQueryOrdered, $searchValue, $searchColumns);
        // paginate
        return $objectQueryFiltered->paginate($length);
    }
    public function drawSearchableTable(Request $request, $objectQuery, $columnsArray = null)
    {
        $items = $this->getObjectSearchableData($request, $objectQuery, $columnsArray);
        // return
        return ['data' => $items, 'draw' => $request->input('draw')];
    }
}