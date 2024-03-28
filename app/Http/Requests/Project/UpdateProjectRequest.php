<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('project');

        return [
            'title' => ['required','string','min:3','max:50', Rule::unique('projects')->ignore($id)],
            'description' => 'required|string|min:5|max:10000',
            'preview_project' => 'nullable|mimes:jpeg,jpg,png',
            'end_date' => 'nullable|date',
            'is_published' => 'nullable',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatiorio',
            'title.unique' => "Esiste già un progetto intitolato: {$this->title}",
            'title.min' => 'Il titolo deve avere minimo :min caratteri',
            'title.max' => 'Il titolo deve avere massimo :max caratteri',
            'description.required' => 'La descrizione è obbligatoria',
            'description.min' => 'La descrizione deve avere minimo :min caratteri',
            'description.max' => 'La descrizione deve avere massimo :max caratteri',
            'end_date.date' => 'Deve essere una data valida',
            'type_id.exists' => 'Tipo non valido',
            'technologies.exists' => 'Tecnologia non valida'
        ];
    }
}
