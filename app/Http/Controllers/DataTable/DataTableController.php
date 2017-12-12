<?php

namespace App\Http\Controllers\DataTable;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Schema;

abstract class DataTableController extends Controller
{   
    protected $builder;

    abstract public function builder();

    public function __construct()
    {
        $builder = $this->builder();

        if (!$builder instanceof Builder) {
            throw new Exception('Entity builder not instance of Builder');
        }

        $this->builder = $builder;
    }

    /** 
     * Get records.
     * 
     * @return Illminate\Http\
    */

    public function index()
    {
        return response()->json([
            'data' => [
                'table' => $this->builder->getModel()->getTable(),
                'displayable' => array_values($this->getDisplayableColumns()),
                'records' => $this->getRecords(),
            ]
        ]);
    }

    public function getDisplayableColumns()
    {
        return array_diff($this->getDatabaseColumnNames(), $this->builder->getModel()->getHidden());
    }

    public function getDatabaseColumnNames()
    {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }

    protected function getRecords()
    {
        return $this->builder->get($this->getDisplayableColumns());
    }
}