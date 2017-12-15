<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;

class PlanController extends DataTableController
{
    public function builder()
    {
        return Plan::query();
    }
}
