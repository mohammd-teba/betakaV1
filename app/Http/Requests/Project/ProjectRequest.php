<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'language' => 'required|in:' . implode(',', config('languages.supported')),
//            'images.*' => 'nullable|image|mimes:png,jpg,jpeg',
            'small_image' => 'required|image',
            'url' => 'nullable|string',
            'category_id' => 'required|integer',
            'title.*' => 'required',
            'description.*' => 'required',
            'country.*' => 'nullable',
        ];
    }
}
