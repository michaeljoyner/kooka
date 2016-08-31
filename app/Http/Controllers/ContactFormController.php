<?php

namespace App\Http\Controllers;

use App\Mailing\AdminMailer;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContactFormController extends Controller
{
    public function handleMessage(Request $request, AdminMailer $mailer)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $mailer->conveySiteMessage($request->only(['name', 'email', 'enquiry']));

        return response()->json('ok');
    }
}
