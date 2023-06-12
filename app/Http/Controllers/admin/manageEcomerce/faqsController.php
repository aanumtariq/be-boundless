<?php

namespace App\Http\Controllers\admin\manageEcomerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\faq;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Exception;

class faqsController extends Controller
{
    //
    public function getFAQs(Request $req)
    {
        if ($req->has('getEditFAQ')) {
            $faqData = faq::where('Id', $req->getEditFAQ)->first();
            return response()->json(['faqData' => $faqData]);
        } else {
            $faqsData = faq::where('isVideo', 0)->get();
            $faqVid = faq::where('isVideo', 1)->first();
            return view('admin.manageEcom.manageFAQ', ['faqs' => $faqsData, 'faqVid' => $faqVid]);
        }
    }

    public function faqVSave(Request $req)
    {
        try {
            faq::where('Id', $req->fId)->update(['question' => $req->faqVTitle, 'answer' => $req->faqVLink]);
            // return response()->json(['message' => 'success']);

            return redirect()->back()->with('notify_message', 'Updated Successfully');
        } catch (Exception $e) {
            // return response()->json(dd($e));
            return redirect()->back()->with('notify_message', 'Failed to Update Settings. Please Try Again!');
        }
    }
    public function addFAQ(Request $req)
    {
        if ($req->formType == "update") {
            try {

                if ($req->addFAQCheck == 'on') {
                    $addFAQCheck = 1;
                } else {

                    $addFAQCheck = 0;
                }
                faq::where('Id', $req->fId)->update(['question' => $req->faqQues, 'answer' => $req->faqAns, 'faqActive' => $addFAQCheck]);
                return response()->json(['message' => 'success']);
            } catch (Exception $e) {
                return response()->json(dd($e));
            }
        } else {
            try {


                if ($req->addFAQCheck == 'on') {
                    $addFAQCheck = 1;
                } else {

                    $addFAQCheck = 0;
                }
                $faqDB = new faq();
                $faqDB->question = $req->faqQues;
                $faqDB->answer = $req->faqAns;
                $faqDB->faqActive = $addFAQCheck;
                if ($faqDB->save()) {
                    return response()->json(['message' => 'success']);
                } else {
                    return response()->json(['message' => 'Error']);
                }
            } catch (Exception $e) {
                return response()->json(dd($e));
            }
        }
    }

    public function delFAQ(Request $req)
    {
        try {
            DB::table('faqs')->where('Id', $req->fId)->delete();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function faqActive(Request $req)
    {
        try {
            faq::where('Id', $req->faqId)->update(['faqActive' => $req->faqActive]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
    
    public function getUsers(Request $req)
    {

        $usersData = User::all();
        return view('admin.manageEcom.users', ['users' => $usersData]);
    }

    public function delUsers(Request $req)
    {
        try {
            DB::table('users')->where('id', $req->deleteUsers)->delete();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function usersActive(Request $req)
    {
        try {
            User::where('id', $req->usersId)->update(['uActive' => $req->usersActive]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }
}
