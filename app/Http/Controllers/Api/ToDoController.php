<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateToDoRequest;
use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function getAll()
    {
        $toDoList = ToDo::all()->toArray();

        return response()->json(
            [
                'total' => count($toDoList),
                'todos' => $toDoList
            ]
        );
    }

    public function getOne(int $toDoId)
    {
        $toDo = ToDo::findOrFail($toDoId);
        return response()->json($toDo->toArray());
    }

    public function markAsDone(int $toDoId)
    {
        $toDo = ToDo::findOrFail($toDoId);
        $toDo->done = true;

        $toDo->save();

        return response()->json([]);
    }

    public function create(CreateToDoRequest $request)
    {
        $data = $request->validated();

        $toDo = new ToDo($data);
        $toDo->save();

        return response()->json([]);
    }

    public function update(int $toDoId, Request $request)
    {
        $data = $request->only(['todo']);

        $toDo = ToDo::findOrFail($toDoId);
        $toDo->todo = $data['todo'];
        $toDo->save();

        return response()->json([]);
    }

    public function delete(int $toDoId)
    {
        $todo = ToDo::findOrFail($toDoId);
        $todo->delete();

        return response()->json([]);
    }
}

