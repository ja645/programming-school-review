<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\Facades\Validator;

class ContactFormRequestTest extends TestCase
{
    /**
     * ContactFormRequestが正しく機能するかテスト
     * @param array $dataList
     * @param bool $expected
     * @return void
     * @dataProvider dataContactForm
     */
    public function testWorkContactFormRequest(array $keys, array $values, bool $expected)
    {        
        $request = new ContactFormRequest();
        $rules = $request->rules();

        $dataList = array_combine($keys, $values);

        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array
     */
    public function dataContactForm()
    {
        return [
            '正常' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['test', 0, 'test@gmail.com', str_repeat('a　aa', 10), str_repeat('a a', 500)], //titleは全角スペース、inquiryは半角スペースを含んでいる 
                true,
            ],
            'nameがnullでエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['', 0, 'test@gmail.com', str_repeat('a　aa', 10), str_repeat('a a', 500)],
                false,
            ],
            'have_accountが論理値以外でエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['test', 2, 'test@gmail.com', str_repeat('a　aa', 10), str_repeat('a a', 500)],
                false,
            ],
            'emailが形式外でエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['', 0, 'test@gmail.comあいうえお', str_repeat('a　aa', 30), str_repeat('a a', 500)],
                false,
            ],
            'emailがnullでエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['', 0, '', str_repeat('a　aa', 10), str_repeat('a a', 500)],
                false,
            ],
            'titleがnullでエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['', 0, 'test@gmail.com', '', str_repeat('a a', 500)],
                false,
            ],
            'titleが30字以上でエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['', 0, 'test@gmail.com', str_repeat('a　aa', 10), str_repeat('a a', 500)],
                false,
            ],
            'inquiryがnullでエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['', 0, 'test@gmail.com', str_repeat('a　aa', 30), ''],
                false,
            ],
            'inquiryが1000字以上でエラー' => [
                ['name', 'have_account', 'email', 'title', 'inquiry'],
                ['', 0, 'test@gmail.com', str_repeat('a　aa', 30), str_repeat('a a', 501)],
                false,
            ],
        ];
    }
}
