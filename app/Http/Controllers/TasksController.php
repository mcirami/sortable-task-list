<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function show(Task $tasks) {

        $allTasks = Task::all();
        $tasks = $allTasks->sortBy('priority');

        return view('tasks.index')->with('tasks' , $tasks);
    }

    public function store(Request $request, Task $task) {

        // Validate input data
        $this->validate($request, [
           'name' => 'required|string|max:255',
           'priority' => 'required|integer'
        ]);

        $task->name = $request->input('name');
        $task->priority = $request->input('priority');
        $task->save();

        return redirect()->back()->with('success', 'Task Created');
    }

    public function destroy(Request $request) {
        $taskID = $request->input('id');

        $task = Task::find($taskID);
        $task->delete();

        return redirect()->back()->with('success', 'Task Deleted');
    }

    public function edit(Request $request) {
        $taskID = $request->input('id');
        $task = Task::find($taskID);

        return view('tasks.edit')->with('task' , $task);

    }

    public function update(Request $request, Task $task) {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'priority' => 'required|integer'
        ]);

        $taskID = $request->input('id');
        $task = Task::find($taskID);

        $task->name = $request->input('name');
        $task->priority = $request->input('priority');
        $task->save();

        return redirect('/tasks')->with('success' , 'Your Task Was Updated');

    }
}
