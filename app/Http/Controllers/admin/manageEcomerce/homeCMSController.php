<?php

namespace App\Http\Controllers\admin\manageEcomerce;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Exception;

class homeCMSController extends Controller
{
    public function saveCMS(Request $req,$tableName)
    {
        try {          
            foreach ($req->all() as $key => $value) {
                if ($key == '_token') {
                    continue;
                }
                $name = explode('-',$key);
                if ($name[0] == "is_image") {
                    $delDB = DB::table($tableName)->where('var_text',  $name[1])->select('var_value')->first();                    
                    File::exists(public_path($delDB->var_value)) ? File::delete(public_path($delDB->var_value)) : 'File does not exists.';

                    $editImg = $req->file($key);
                    $editImageName = strtotime(now()) . rand(11111, 99999) . '-' . $this->getSlug($name[1]);
                    $editImageName = Helper::OPImageResize($editImg, $editImageName, 'images/uploads/CMS/', 225, 255, false, 0, 0);              
                    DB::table($tableName)->where('var_text', $name[1])->update(['var_value' => $editImageName['file']]);
                }
                elseif ($name[0] == "is_video" || $name[0] == "is_banner") {
                    $delDB = DB::table($tableName)->where('var_text',  $name[1])->select('var_value')->first();                    
                    File::exists(public_path($delDB->var_value)) ? File::delete(public_path($delDB->var_value)) : 'File does not exists.';

                    $editImg = $req->file($key);
                    $editImageName = strtotime(now()) . rand(11111, 99999) . '-' . $this->getSlug($name[1]).'.'.$editImg->getClientOriginalExtension();
                    $req->file($key)->move(public_path() . '/images/uploads/CMS/', $editImageName);                                 
                    DB::table($tableName)->where('var_text', $name[1])->update(['var_value' => 'images/uploads/CMS/'.$editImageName]);                
                }            
                else {
                    

                    DB::table($tableName)->where('var_text', $key)->update(['var_value' => $value]);                 
                }                                     
            }                                                    
            return 'success';
        } catch (Exception $e) {               
            return dd($e);
        }
    }

    //About
    public function getAbout()
    {   
        return view('admin.homeCMS.simpleCMS',['tableName'=>'about_cms']);       
    }
    public function upAbout(Request $req)
    {                   
       
        $return = $this->saveCMS($req,'about_cms');
        if ($return == 'success') {
            return redirect()->back()->with('notify_message', 'Updated Successfully');
        }else {
            return redirect()->back()->with('notify_message', 'Failed to Update Settings. Please Try Again!');
        }        
    }
}