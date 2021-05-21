<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditorialProjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); //per controllare che l'utente sia loggato | superfluo nel nostro caso grazie al middleware, funge da controllo aggiuntivo
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'sector_id' => 'required|exists:sectors,id',
            'author_id'=> 'sometimes|exists:users,id',
        ];
    }
}
