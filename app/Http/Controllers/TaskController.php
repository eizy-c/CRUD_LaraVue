<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::orderBy('id', 'DESC')->paginate(5);

        return [
            'pagination' => [
                'total'         => $tasks->total(),
                'current_page'  => $tasks->currentPage(),
                'per_page'      => $tasks->perPage(),
                'last_page'     => $tasks->lastPage(),
                'from'          => $tasks->firstItem(),
                'to'            => $tasks->lastItem(),
            ],
            'tasks' => $tasks
        ];
    }

    public function store(Request $request)
    {
        $request->validate([
            'keep'          => 'required'
        ]);
        
        Task::create($request->all());
        return;

    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'keep'          => 'required'
        ]);

        $task->update($request->all());

        return;
    }

    public function destroy($id)
    {
        $task = Task::find($id);

        $task->delete();
    }
}
