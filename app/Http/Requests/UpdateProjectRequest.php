<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_name' => 'required|unique:projects|max:50|string',
            'project_name' => [
                'required',
                'max:50',
                'string',
                Rule::unique('projects')->ignore($this->project)
            ],
            'description' => 'required|string',
            'programming_languages' => 'required|string',
            'start_date' => 'required|date',
            'image' => 'nullable|image',
            'set_image' => 'boolean'
        ];
    }
}
