<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Admin\TaskRequest;
use App\Models\Task;
use App\Models\TaskHandler;
use Illuminate\Http\JsonResponse;

class TaskApiController extends AdminApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(
            __('crud.indexed'),
            Task::with(['section'])->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest  $request
     *
     * @return JsonResponse
     */
    public function store(TaskRequest $request): JsonResponse
    {
        try {
            $task = Task::create($request->only(['section_id', 'task_handler_id', 'is_active', 'title', 'description', 'order']));

            return $this->success(__('crud.stored'), $task, 201);
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     *
     * @return JsonResponse
     */
    public function show(Task $task): JsonResponse
    {
        return $this->success(__('crud.shown'), $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest  $request
     * @param  Task  $task
     *
     * @return JsonResponse
     */
    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        try {
            $task->update($request->only(['section_id', 'task_handler_id', 'is_active', 'title', 'description', 'order']));

            return $this->success(__('crud.updated'), $task);
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     *
     * @return JsonResponse
     */
    public function destroy(Task $task): JsonResponse
    {
        try {
            $task->delete();

            return $this->success(__('crud.destroyed'));
        } catch (\Throwable $e) {
            return $this->error(__('crud.something_wrong'), 500, $e->errorInfo);
        }
    }

    public function handlers ()
    {
        return $this->success(__('crud.indexed'), TaskHandler::pluck('name', 'id'));
    }
}
