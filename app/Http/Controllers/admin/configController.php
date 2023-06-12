<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\contact;
use App\Models\m_flag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class configController extends Controller
{
    //
    public function __construct()
    {
        View()->share('v', config('app.vadmin'));
    }

    public function quries()
    {
        $contactDB = contact::all();
        return view('admin.manageEcom.quries')->with(['contactDB' => $contactDB]);
    }

    public function delQuries(Request $req)
    {
        try {
            DB::table('contacts')->where('id', $req->deleteQuries)->delete();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function config()
    {
        return view('admin.config')->with('configMenu', true)->with('title', 'Additional Settings');
    }
    public function themeSave(Request $req)
    {
        // DB::UPDATE("UPDATE m_flags set flag_value = '" . $value . "',flag_additionalText = '" . $value . "' where flag_type = 'CURRENTHEME'");

        m_flag::where('flag_type', 'CURRENTHEME')
            ->update([
                'flag_value' => $req->currentTheme,
                'flag_additionalText' => $req->currentTheme
            ]);
        return response()->json(['Successfully']);
    }
    public function configSave()
    {
        $errorsUpload = 0;
        if (isset($_POST)) {
            foreach ($_POST as $key => $value) {
                if ($key == '_token') {
                    continue;
                }
                DB::UPDATE("UPDATE m_flags set flag_value = '" . $value . "',flag_additionalText = '" . $value . "' where flag_type = '" . $key . "'");
                $errorsUpload = 1;
            }
        }
        return redirect()->route('admin.config')->with('notify_message', $errorsUpload == 1 ? 'Updated Successfully' : 'Failed to Update Settings. Please Try Again!');
    }
}
