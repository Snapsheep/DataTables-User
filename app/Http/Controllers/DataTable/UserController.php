<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends DataTableController
{
    public function builder()
    {
        return User::query();
    }

    public function getDisplayableColumns()
    {
        return [
            'id', 'name', 'email', 'created_at'
        ];
    }

    public function getUpdatableColumns()
    {
        return [
            'name', 'email', 'created_at'
        ];
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }
}
