<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\CreateGroupRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function store(CreateGroupRequest $request)
    {
        $group = new Group($request->validated());

        $group->save();
    }
}
