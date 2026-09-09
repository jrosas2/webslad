<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->is_admin === true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:180'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:170'],
            'og_image' => ['nullable', 'string', 'max:500'],
            'is_active' => ['nullable', 'boolean'],
            'sections' => ['required', 'array'],
            'sections.*.title' => ['nullable', 'string', 'max:255'],
            'sections.*.subtitle' => ['nullable', 'string', 'max:1000'],
            'sections.*.content' => ['nullable', 'string', 'max:50000'],
            'sections.*.sort_order' => ['required', 'integer', 'min:0', 'max:999'],
            'sections.*.is_active' => ['nullable', 'boolean'],
        ];
    }

    /** @return array<int, callable> */
    public function after(): array
    {
        return [function (Validator $validator): void {
            foreach ((array) $this->input('sections', []) as $id => $section) {
                if (blank($section['content'] ?? null)) {
                    continue;
                }

                json_decode((string) $section['content'], true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $validator->errors()->add("sections.$id.content", 'El contenido estructurado debe ser JSON válido.');
                }
            }
        }];
    }
}
