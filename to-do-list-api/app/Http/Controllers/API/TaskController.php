<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;

use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a tasks list
     */
    public function index()
    {
        return response()->json([
            'tasks' => Task::all(),
        ]);
    }

    /**
     * Store a new task
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'title'     => $request->title,
            'completed' => $request->completed,
        ]);

        return response()->json([
            'task' => $task,
        ]);
    }

    /**
     * Update an existing task
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);

        $task->update([
            'title'     => $request->title,
            'completed' => $request->completed,
        ]);

        return response()->json([
            'task' => $task,
        ]);
    }

    /**
     * Delete an existing task
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json([
            'task' => $task,
        ]);
    }
}
