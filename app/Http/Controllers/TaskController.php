<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     *  Display a listing of the resource using cache.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $tasks = Cache::remember('tasks_' . auth()->user()->id, 3600, function () {
            return auth()->user()->tasks()->orderBy('due_date')->get();
        });

        return view('dashboard')->with(['tasks' => $tasks]);
    }


    /**
     *  Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('Tasks.create');
    }

    /**
     *  Store a newly created resource in storage.
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validationData();
            Task::create($data);
            Cache::forget('tasks_' . auth()->user()->id);
            return redirect()->route('dashboard')->with(['success' => true, 'message' => 'Task created successfully.']);
        } catch (\Exception $e) {
            Log::error('Something went wrong adding a new task:' . $e->getMessage());
            return redirect()->route('dashboard')->with(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    /**
     *  Show the form for editing the specified resource.
     * @param Task $task
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('Tasks.edit', ['task' => $task]);
    }

    /**
     *  Update the specified resource in storage.
     * @param UpdateRequest $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Task $task)
    {
        try {
            $data = $request->validationData();
            (new TaskService())->updateTask($data, $task);
            Cache::forget('tasks_' . auth()->user()->id);
            return redirect()->route('dashboard', ['success' => true, 'message' => 'The task has been successfully modified.']);
        } catch (\Exception $e) {
            Log::error('An error occurred while editing the task:' . $e->getMessage());
            return redirect()->route('Tasks.edit')->with(['success' => false, 'message' => $e->getMessage()]);
        }
    }


    /**
     *  Remove the specified resource from storage.
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        try {
            $this->authorize('delete', $task);
            $task->delete();
            Cache::forget('tasks_' . auth()->user()->id);
            return redirect()->route('dashboard')->with(['success' => true, 'message' => 'The task has been successfully deleted.']);

        } catch (\Exception $e) {
            Log::error('Something went wrong deleting the task:' . $e->getMessage());
            return redirect()->route('dashboard')->with(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * toggle status for specific task
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleStatus(Task $task)
    {
        try {
            $task->status = $task->status === 'pending' ? 'completed' : 'pending';
            $task->save();
            Cache::forget('tasks_' . auth()->user()->id);
            return redirect()->route('dashboard')->with(['success' => true, 'message' => 'The task status has been changed successfully.']);

        } catch (\Exception $e) {
            Log::error('An error occurred while modifying the task status:' . $e->getMessage());
            return redirect()->route('dashboard')->with(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
