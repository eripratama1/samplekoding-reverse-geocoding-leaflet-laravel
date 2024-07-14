<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
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
            'name' => ['required', 'min:5'],
            'slug' => ['required'],
            'icon' => ['image']
        ];
    }

    /**
     * Pada method ini kita akan membuat data slug secara otomatis dimana kita akan
     * mendapatkan nilai slug yang sama dengan atribut name pada form ketika user
     * menginputkan nilai pada properti name
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->slug ?: Str::slug($this->name),
        ]);
    }
}
