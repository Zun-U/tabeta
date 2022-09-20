<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Request;

// カスタムバリデーションのインスタンス化
use App\Rules\DynamicFormsRule;
// DynamicFormseRule

class CreateRecipe extends FormRequest
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

        // dd($request->product_image);
        // dd($request->upload_image);
        // dd($request->foodstuff['food']);
        // dd($request->file('upload_image'));
        // dd($request->upload_image['cooking_image']);

        // 食材・調味料フォーム欄バリデーション（最低一つ入力）
        $validation_food = 'required';
        $required_food = [];
        foreach ($request->foodstuff['food'] as $key => $food) {
            empty($food) ? $required_food[] = 'required' : $required_food[] = 'ok';
        }
        if (in_array("ok", $required_food)) {
            $validation_food = 'nullable';
        }


        // 分量フォーム欄バリデーション（最低一つ入力）
        $validation_amount = 'required';
        $required_amount = [];
        foreach ($request->foodstuff['amount'] as $key => $amount) {
            empty($amount) ? $required_amount[] = 'required' : $required_amount[] = 'ok';
        }
        if (in_array("ok", $required_amount)) {
            $validation_amount = 'nullable';
        }


        return [
            'title' => 'required|max:100',
            'subtitle' => 'required|max:100',
            'howmany' => 'required|max:10|integer',

            // 動的フォーム入力欄のバリデーション
            'foodstuff.food.*' => $validation_food,
            'foodstuff.amount.*' =>  $validation_amount,
            'content.text.*' => 'required_without_all|max:100',

            // 画像バリデーション
            'product_image' => 'required|image|mimes:jpeg,png,jpg',
            // 'upload_image.*' => 'required|image|mimes:jpeg,png,jpg',

            'upload_image' => 'nullable|array',
            'upload_image.cooking_image.*' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    // 動的フォーム欄のカスタムバリデーション
    // public function foodValidation()

    public function attributes()
    {
        return [
            'title' => 'レシピ名',
            'subtitle' => 'サブタイトル',
            'howmany' => '人数',
            'foodstuff.food.*' => '材料・調味料',
            'foodstuff.amount.*' => '分量',
            'content.text.*' => '作り方',

            'product_image' => 'レシピ画像',
            'upload_image' => '手順画像',


            'foodstuff.food.*.required' => "食材・調味料を一つ以上記入してください。",
        ];
    }
}