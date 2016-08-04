<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContactFormController extends Controller
{
    public function handleMessage(Request $request)
    {
        sleep(5);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        return response()->json('ok');
    }
}
