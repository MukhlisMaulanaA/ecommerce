<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class   ProductStoreRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  // public function authorize(): bool
  // {
  //   return false;
  // }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'user_id' => 'required',
      'name' => 'required|string|max:255',
      'price' => 'required|numeric',
      'stock_status' => 'required|string',
      'featured_image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
      'excerpt' => 'required|max:255',
      'body' => 'required:max:255'
    ];
  }
}
