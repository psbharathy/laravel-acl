<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreHostNameRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'host_name' => 'required|state_code|station_name|counter_type|bay_location_code|hyphen|add_number|unique:host'
        ];
    }
}
