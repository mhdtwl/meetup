<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

/**
 * Trait SearchableTrait
 * @package App\Traits
 */
trait SearchableTrait
{
    /**
     * @param Request $request
     * @param array $columns
     * @return array
     */
    private function getRequestColumnAndDirection(Request $request, array $columns): array
    {
        $orderIndex = $request->input('column');
        $orderColumn = array_key_exists($orderIndex, $columns) ? $columns[$orderIndex] : $columns[0];
        //-- validation dir
        $dirInput = $request->input('dir') ?? 'asc';// asc default
        $orderDirection = $dirInput;
        return ['Column' => $orderColumn, 'Direction' => $orderDirection];
    }

    /**
     * @param Builder $query
     * @param string|null $searchValue
     * @param Collection $searchColumns
     * @return Builder
     */
    private function getDataObjectFiltered(Builder $query, ?string $searchValue, Collection $searchColumns): Builder
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


    /**
     * @param Request $request
     * @param Builder $objectQuery
     * @param array|null $columnsArray
     * @return LengthAwarePaginator
     */
    public function getObjectSearchableData(Request $request, Builder $objectQuery, ?array $columnsArray)
    {
        $searchColumns = collect($columnsArray['searchColumns']);
        $columns = $columnsArray['dataTableColumns'];
        // validation

        Validator::make($request->all(), [//$request->validate([ $request->all(),
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

    /**
     * @param Request $request
     * @param Builder $objectQuery
     * @param array $columnsArray
     * @return array
     */
    public function drawSearchableTable(Request $request, Builder $objectQuery, ?array $columnsArray): array
    {
        $items = $this->getObjectSearchableData($request, $objectQuery, $columnsArray);
        // return
        return ['data' => $items, 'draw' => $request->input('draw')];
    }
}