<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::select('id', 'title','description', 'status')->get();
            
            return response()->json([
                'success' => true,
                'tasks' => $tasks,
                'message' => 'Tareas obtenidas correctamente',
            ]);

        } catch(Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Error interno al obtener las tareas",
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        try {
            $task = new Task;
            $task->fill($request->all());
            $task->save();
            
            return response()->json([
                'success' => true,
                'tasks' => $task,
                'message' => 'Tarea creada correctamente',
            ]);

        } catch(Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Error interno al crear la tarea",
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        try {
            return response()->json([
                'success' => true,
                'task' => $task,
                'message' => "Tarea $task->title obtenida correctamente",
            ]);

        } catch(Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Error interno al obtener la tarea $task->title",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {
            $task->fill($request->all());
            $task->save();

            return response()->json([
                'success' => true,
                'task' => $task,
                'message' => "Tarea $task->title actualizada correctamente",
            ]);

        } catch(Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Error interno al actualizar la tarea $task->title",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => "Tarea $task->title eliminada correctamente",
            ]);

        } catch(Exception $e) {
            Log::error($e);
            return response()->json([
                'success' => false,
                'message' => "Error interno al eliminar la tarea $task->title",
            ]);
        }
    }
}
