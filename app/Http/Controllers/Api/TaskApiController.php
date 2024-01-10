<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Handlers\AbstractHandler;
use App\Models\Task;
use App\Models\TaskHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskApiController extends ApiController
{
    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     *
     * @return JsonResponse
     */
    public function show(Task $task): JsonResponse
    {
        if ($task->getAttribute('is_active')) {
            $handler = $this
                ->getTaskHandler($task->taskHandler)
                ->findOrGenerate();

            return $this->success(__('crud.shown'), [
                'task' => $task,
                'handler' => $handler,
            ]);
        } else {
            return $this->error(__('crud.not_found'), 404);
        }
    }

    public function check (Task $task, Request $request): JsonResponse
    {
        if ($task->getAttribute('is_active')) {
            $request->validate([
                'answers' => 'required|array'
            ]);

            $answers = array_map('intval', $request->get('answers'));

            $handler = $this
                ->getTaskHandler($task->taskHandler)
                ->findOrGenerate();

            $isCorrect = $handler->check($answers);

            if ($isCorrect)
                $handler->generate();

            return $this->success(__('crud.data_received'), [
                'isCorrect' => $isCorrect,
            ]);
        } else {
            return $this->error(__('crud.not_found'), 404);
        }
    }

    private function getTaskHandler (TaskHandler $taskHandler): AbstractHandler
    {
        $classPath = 'App\Http\Controllers\Api\Handlers\\' . $taskHandler->handler;
        return new $classPath($taskHandler->formula);
    }
}
