<?php

namespace App\Http\Requests\post;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            //'slug' => Str::slug($this->title)
            'slug' => str($this->title)->slug()
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
            "title"=>"required|min:5|max:500",
            "slug"=>"required|min:5|max:500|unique:posts",
            "content"=>"required|min:7",
            "category_id"=>"required|integer",
            "description"=>"required|min:7",
            "posted"=>"required"
        ];
    }
}
