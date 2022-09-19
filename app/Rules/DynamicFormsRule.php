<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DynamicFormsRule implements Rule
{
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    //食材入力欄のカスタムバリデーション
    //動的に追加されたフォーム欄に一つでも存在したら通す

    foreach ($value as $input) {
      if (isset($input)) {
        return true;
      } 
    }
    return false;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return '材料・調味料、分量の入力欄に最低一つ記入が必要です。';
  }
}
