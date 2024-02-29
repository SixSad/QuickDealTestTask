<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends Controller
{

    /**
     * Get all tasks.
     *
     * @return TaskCollection
     */
    public function index(): JsonResource
    {
        return new TaskCollection(Task::query()
            ->name(request('name'))
            ->status(request('status'))
            ->createdAt(request('date'))
            ->paginate(10)
        );
    }

    /**
     * Store a new task.
     *
     * @param StoreTaskRequest $request
     * @return TaskResource
     */
    public function store(StoreTaskRequest $request): JsonResource
    {
        $validatedRequest = $request->validated();
        $task = Task::query()->create($validatedRequest);

        return new TaskResource($task);
    }

    /**
     * Get task from id.
     *
     * @param int $id
     * @return TaskResource
     */
    public function show(int $id): TaskResource
    {
        $task = Task::query()->findOrFail($id);
        return new TaskResource($task);
    }

    /**
     * Update task from id.
     *
     * @param UpdateTaskRequest $request
     * @param int $id
     * @return TaskResource
     */
    public function update(UpdateTaskRequest $request, int $id): TaskResource
    {
        $task = Task::query()->findOrFail($id);
        $validatedRequest = $request->validated();
        $task->update($validatedRequest);
        return new TaskResource($task);
    }

    /**
     * Delete task from id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Task::query()->findOrFail($id)->delete();

        return response()->json(['status' => 'Task deleted']);
    }
}
