<?php

namespace App\Http\Requests\Admin;

use App\Models\Section;
use App\Models\TaskHandler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $sectionIds = Section::pluck('id')->implode(',');
        $taskHandlerIds = TaskHandler::pluck('id')->implode(',');

        return [
            'section_id' => 'required|in:' . $sectionIds,
            'task_handler_id' => 'required|in:' . $taskHandlerIds,
            'is_active' => 'nullable|boolean',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ];
    }
}
