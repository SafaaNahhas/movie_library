<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
{
    // يتوقف عن عملية التحقق عند أول فشل ويرد رسالة
    protected $stopOnFirstFailure =true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function prepareForValidation(){
        $this->merge([
            'release_year' => preg_replace('/\D/','',$this->release_year),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'director' => 'sometimes|string|max:255',
            'genre' => 'sometimes|string|max:255',
            'release_year' => 'sometimes|integer',
            'description' => 'nullable|string',
        ];
    }

}
