<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AddressUpdateRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'id' => ['required'],
      'user_id' => ['required'],
      'label' => ['string', 'required'],
      'is_primary' => ['boolean', 'required'],
      'first_name' => ['string', 'max:255'],
      'last_name' => ['string', 'max:255'],
      'address1' => ['string', 'max:255'],
      'address2' => ['string', 'max:255'],
      'phone' => ['string', 'max:255'],
      'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->email)],
      'province' => ['int'],
      'city' => ['int'],
      'postcode' => ['integer', 'max_digits:9'],
    ];
  }
}
