<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMovieRequest extends FormRequest
{
   /**
 * This property will stop the validation process after the first validation failure.
 *
 * @var bool
 */
    protected $stopOnFirstFailure =true;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
      /**
 * Prepare the data for validation.
 *
 * This method is used to modify the input data before it is validated.
 * Here, it removes all non-digit characters from the 'release_year' field
 * to ensure that only numeric data is passed for validation.
 *
 * @return void
 */
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
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'release_year' => 'required|integer',
            'description' => 'nullable|string',
        ];
    }
}
