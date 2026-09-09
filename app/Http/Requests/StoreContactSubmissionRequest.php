<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactSubmissionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'submission_token' => ['required', 'uuid'],
            'name' => ['required', 'string', 'max:120'],
            'company' => ['required', 'string', 'max:160'],
            'position' => ['nullable', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['nullable', 'string', 'max:40'],
            'estimated_users' => ['nullable', Rule::in(['1-5', '6-15', '16-50', '51+'])],
            'needs' => ['nullable', 'array', 'max:7'],
            'needs.*' => [Rule::in(['causas', 'actuaciones', 'documentos', 'recordatorios', 'gestion-financiera', 'importacion-excel', 'otro'])],
            'message' => ['required', 'string', 'max:3000'],
            'website' => ['nullable', 'max:0'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'name.required' => 'Ingrese su nombre completo.',
            'company.required' => 'Ingrese la empresa u organización.',
            'email.required' => 'Ingrese su correo institucional.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'message.required' => 'Cuéntenos brevemente qué necesita gestionar.',
            'message.max' => 'El mensaje no puede superar los 3.000 caracteres.',
        ];
    }
}
