<?php

namespace Creatify\Authentication\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Creatify\Authentication\Http\Traits\ApiResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\Recaptcha;
use Illuminate\Contracts\Validation\Validator;



class PinCode extends FormRequest
{

    use  ApiResponseTrait;
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

            'pin_code' => 'required',
            'email' => 'required',
            // 'g-recaptcha-response' => ['required', new Recaptcha]

        ];
    }




    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $this->apiResponseValidation($validator);
    }
}
