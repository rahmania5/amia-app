<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Distributor;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (auth()->user()->distributor) {
            return [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
                'nik' => ['required', 'min:16', 'max:16', Rule::unique((new Distributor)->getTable())->ignore(auth()->user()->distributor->id)],
                'alamat' => ['required'],
                'no_telepon' => ['required'],
                'photo' => ['nullable', 'image'],
            ];
        } else {
            return [
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique((new User)->getTable())->ignore(auth()->id())],
                'photo' => ['nullable', 'image'],
            ];
        }
    }
}
