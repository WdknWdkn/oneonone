<?php

namespace App\Queries;

use Illuminate\Http\Request;
use App\Models\User;

class UserQuery
{
    protected $query;
    protected $request;
    protected $params;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->query = User::query();
        $this->params = $request->all();
    }

    public function apply()
    {
        $name = $this->request->input('name');
        if ($name) {
            $this->query->where('name', 'LIKE', '%' . $name . '%');
        }

        $email = $this->request->input('email');
        if ($email) {
            $this->query->where('email', 'LIKE', '%' . $email . '%');
        }

        $departmentId = $this->request->input('department_id');
        if ($departmentId) {
            $this->query->where('current_department_id', $departmentId);
        }

        $positionId = $this->request->input('position_id');
        if ($positionId) {
            $this->query->where('current_position_id', $positionId);
        }

        // クエリビルダーを返す
        return $this->query;
    }

    public function getParams()
    {
        return $this->params;
    }
}
