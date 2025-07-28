<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskCreator;
use App\Models\TaskAttachment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class IdeaController extends Controller
{
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'issue' => 'nullable|string',
            'description' => 'nullable|string',
            'creator' => 'required|string|max:255', 
            'email' => 'required|email|max:255', 
            'contributors' => 'nullable|string', 
            'file' => 'nullable|file|max:5048|mimes:jpg,jpeg,png,pdf,doc,docx', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

       
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'notes' => $request->notes,
            'issue' => $request->issue,
            'status' => 'eingereicht',
        ]);

        
        TaskCreator::create([
            'task_id' => $task->id,
            'creator' => $request->creator,
            'email' => $request->email, 
        ]);

        
        $contributors = json_decode($request->input('contributors'), true);

        if (is_array($contributors)) {
            foreach ($contributors as $contributor) {
                if (!empty($contributor['displayName']) && !empty($contributor['email'])) { 
                    TaskCreator::create([
                        'task_id' => $task->id,
                        'creator' => $contributor['displayName'], 
                        'email' => $contributor['email'], 
                    ]);
                } else {
                    Log::warning("falsches contributor", ['data' => $contributor]);
                }
            }
        } else {
            Log::error("fehler: Contributors isrt kein array!", ['received' => $contributors]);
        }

       
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = "attachments/{$fileName}";

            // Загружаем файл в Azure Blob Storage
            Storage::disk('azure')->put($filePath, file_get_contents($file));

            // Сохраняем в БД путь к файлу
            TaskAttachment::create([
                'task_id' => $task->id,
                'file_path' => $filePath,
                'file_name' => $file->getClientOriginalName(),
            ]);
        }

        return response()->json([
            'message' => 'Idea submitted successfully!',
            'task' => $task,
            'file_url' => isset($filePath) ? Storage::disk('azure')->url($filePath) : null, 
        ], 201);
        
    }
}
