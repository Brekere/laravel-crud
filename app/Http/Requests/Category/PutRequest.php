<?php

namespace App\Http\Requests\category;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PutRequest extends FormRequest
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
        return [
            "title"=>"required|min:5|max:500",
            "slug"=>"required|min:5|max:500".$this->route("category")->id,
        ];
    }

    function failedValidation(Validator $validator)
    {
        if($this->expectsJson())
            {
                $response = new Response($validator->errors(),422);
                throw new ValidationException($validator, $response);
            }
    }
}
