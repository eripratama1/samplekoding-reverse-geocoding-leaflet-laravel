<?php

namespace App\Http\Requests\Spot;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class UpdateSpotRequest extends FormRequest
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
            'name' => ['required','min:4'],
            'slug' => ['required'],
            'image_path' => ['image','mimes:png,jpg,jpeg'],
            'lat' => ['required'],
            'lng' => ['required'],
            'category_id' => ['required'],
            'description' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->slug ?: Str::slug($this->name),
        ]);
    }


}
