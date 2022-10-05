<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Auth;


class EditUser extends FormRequest
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
   * @return array
   */
  public function rules(Request $request)
  {

    $user = Auth::user();
    // dd($this->id);

    return [
      'name' => 'required|max:255',
      'email' => [
        'required',
        'max:255',
        'email',
        'string',
        Rule::unique('users')->ignore($user->id),
      ],
      'password' => ($user->id) ? 'nullable|min:8' : 'required|min:8',
    ];
  }


  public function attributes()
  {
    return [
      'name' => '名前',
      'email' => 'メールアドレス',
      'password' => 'パスワード',
    ];
  }
}
