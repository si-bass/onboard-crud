<?php

namespace App\Http\Requests;

use App\Http\Response\HttpResponse;
use App\Models\Role;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserSetRolesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'roles' => ['required', 'array', 'min:1', 'string'],
            'roles.*' => ['in:' . implode(",", Role::all()->map(fn ($role) => $role->name)->toArray())]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(status: 400, data: HttpResponse::invalidArgument($validator->errors()->all())));
    }
}
