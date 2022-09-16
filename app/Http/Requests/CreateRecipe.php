<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'subtitle' => 'required|max:100',
            'howmany' => 'required|max:2|integer',
            'foodstuff[food][]' => 'required_without_all|max:100',
            'foodstuff[amount][]' => 'required_without_all|max:100',
            // 'content[text][0]' => 'required|max:100',

            // 画像バリデーション
            'product_image' => 'required|image|mimes:jpeg,png,jpg',
            // 'upload_image[cooking_image][0]' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'レシピ名',
            'subtitle' => 'サブタイトル',
            'howmany' => '人数',
            // 'foodstuff[food][0]' => '材料・調味料',
            // 'foodstuff[amount][0]' => '分量',
            // 'content[text][0]' => '作り方',

            'product_image' => 'レシピ画像',
            // 'upload_image[cooking_image][0]' => '手順画像',
        ];
    }
}
