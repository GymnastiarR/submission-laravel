<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreArticleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if ($this->request->has('publish')) {
            return [
                'slug' => ['required', 'string', 'unique:articles', 'regex:/^[a-zA-Z\-]+$/'],
                'content' => ['required', 'string'],
                'title' => ['required', 'string'],
                'thumbnail' => [File::types('jpg', 'png', 'jpeg')],
                'category' => ['required', 'exists:categories,id'],
            ];
        }

        return [
            'slug' => ['string', 'unique:articles', 'regex:/^[a-zA-Z\-]+$/'],
            'thumbnail' => [File::types('jpg', 'png', 'jpeg')],
            'category' => ['exists:categories,id'],
        ];
    }
}
