<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Review;
use App\Models\School;
use App\Http\Requests\ContactFormRequest;

class HomeController extends Controller
{
    /**
     * トップページを表示
     * @return view
     */
    public function index()
    {
        $schools = School::all();
        return view('layouts.top', ['schools' => $schools]);
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
     * @param \App\Http\Requests\ContactFormRequest $request
     * @return view
     */
    public function receiveContact(ContactFormRequest $request)
    {
        logger($request->all());

        $contact_form = $request->all();
        $contact = new Contact;

        $contact->fill($contact_form)->save();

        return view('layouts.contact.success');
    }
}
