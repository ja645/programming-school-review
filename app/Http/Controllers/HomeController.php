<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Review;

use function Psy\debug;

class HomeController extends Controller
{
    /**
     * トップページを表示
     * @return view
     */
    public function index()
    {
        return view('layouts.top');
    }

    /**
     * お問い合わせフォームを送信
     * @return view
     */
    public function showContactForm()
    {
        return view('layouts.contact');
    }

    /**
     * お問い合わせフォームの内容をcontactsテーブルに保存する
     * @param \Illuminate\Http\Request $request
     * @return view
     */
    public function receiveContact(Request $request)
    {
        $contact_form = $request->all();

        $contact = new Contact;

        $contact->fill($contact_form)->save();

        return view('layouts.contact.success');
    }

    public function why()
    {
        return view('layouts.why');
    }
}
