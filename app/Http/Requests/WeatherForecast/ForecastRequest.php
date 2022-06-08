<?php

namespace App\Http\Requests\WeatherForecast;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ForecastRequest extends FormRequest
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
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'mode' => [
                'sometimes',
                'required',
                'string',
                Rule::in(['xml']),
            ],
            'units' => [
                'sometimes',
                'required',
                'string',
                Rule::in([
                    'standard',
                    'metric',
                    'imperial',
                ]),
            ],
            'cnt' => 'sometimes|required|numeric|min:1|max:40',
            'lang' => [
                'sometimes',
                'required',
                'string',
                Rule::in(array_keys(config('services.open_weather.lang'))),
            ],
        ];
    }
}
