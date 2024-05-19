<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParcelCheckout extends FormRequest
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
            'items.*.description' => 'required|max:300|string',
            'items.*.weight_kg' => 'required_without:items.*.weight_g',
            'items.*.weight_g' => 'required_without:items.*.weight_kg',
            'items.*.value' => 'required|integer',
            'deliveryType' => 'required',
            'user_id' => 'nullable|exists:users,user_id',
            'address' => 'required',
            'apartment' => 'integer',
            'region' => 'required',
            'city' => 'required',
            'street' => 'required',
            'house' => 'required',
            'premise' => 'required',
            'postal_code' => 'required',
            'sender_name' => 'required|max:50|string',
            'sender_surname' => 'required|max:50|string',
            'sender_city' => 'required|max:50|string',
            'sender_address' => 'required|max:50|string',
            'sender_postal_code' => 'required|integer|min:7|max:7',
            'recipient_name' => 'required|max:50|string',
            'telephone' => 'required|min:7|regex:/^[\d\+\(\)\-]+$/',
            'email' => 'required|email',
            'password' => 'min:8|confirmed'
        ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sender_name.required' => 'Укажите имя отправителя',
            'sender_surname.required' => 'Укажите фамилию отправителя',
            'address.required' => 'Заполните адрес доставки',
            'telephone.required' => 'Укажите номер телефона',
            'telephone.min' => 'Телефон должен быть минимум 7 цифр',
            'telephone.regex' => 'Телефон может содержать цифры,"+" скобки и тире',
            'name.alpha' => 'Имя может содержать только буквы',
            'name.required' => 'Имя обязательно для доставки',
            'surname.alpha' => 'Фамилия может содержать только буквы',
            'surname.required' => 'Фамилия обязательнa для доставки',
            'middle_name.alpha' => 'Отчество может содержать только буквы',
            'middle_name.required' => 'Отчество обязательно для доставки',
            'email.email' => 'укажите корректный email адрес',
            'password.min' => 'пароль должен содержать не менее 8 символов',
            'password.confirmed' => 'подтверждение пароля должно совпадать',
            'items.*.description' => 'добавьте описание вложения',
            'items.*.weight_kg' => 'укажите вес вложения',
            'items.*.weight_g' => 'укажите вес вложения',
            'deliveryType.required' => 'выберите тип доставки'
        ];
    }
}
