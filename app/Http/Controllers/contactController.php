<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\m_flag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class contactController extends Controller
{
    //
    public function storeContactForm(Request $request)
    {        
        $input = $request->all();

        contact::create($input);
        
        
        return response()->json(['status' => 'success', 'msg' => 'We Have Recieved Your Message']);            
    }
    
    
    
     public function storeCompareForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'numeric',
            // 'subject' => 'required',
            // 'message' => 'required',
        ]);

        $input = $request->all();

        contact::create($input);
        $data = array(
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'link' => $input['link'],
            'budget' => $input['budget'],
            'subject' => "Email Recieved",
            'messages' => $input['message'],
            'file' => $input['file'],
        );
        //  Send mail to admin
         $config = m_flag::where('flag_type', 'COMPANYEMAIL')->select('flag_value')->first();
        Mail::send('extends.contactMail', $data, function ($message) use ($request, $config) {
            $message->from($request->email);
            $message->to($config->flag_value)->subject($request->get('subject'));
            // $message->to('nitzfurnituretawkto@gmail.com')->subject($request->get('subject'));
        });
        return redirect()->to(URL::previous() . "#contactUs")->with(['success' => 'We Have Recieved Your Message']);
    }
}
