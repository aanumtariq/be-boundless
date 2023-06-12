<?php

namespace App\Http\Controllers\admin\manageEcomerce;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\studio;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class studioController extends Controller
{
    //    
    public function CRUDstudGetEdit($id)
    {
        $studData = studio::where('Id', $id)->first();      
        return view('admin.manageEcom.studioCRUD', ['type' => 'u', 'studData' => $studData]);
    }
    public function CRUDStudio()
    {
        $studData = studio::all();       
        return view('admin.manageEcom.studioCRUD', ['studio' => $studData]);
    }
    public function getStudio(Request $req)
    {
        if ($req->has('getStudId')) {
            $studImages =   $studData = studio::where('Id', $req->getStudId)->first();
            if ($studImages) {

                $sImagesPath[] =  base64_encode(file_get_contents($studImages->sImage));
            } else {
                $sImagesPath = '';
            }
            return response()->json(['studData' => $studData, 'studImages' => $studImages, 'sImagesPath' => $sImagesPath]);
        } else {

            $studData = studio::all();           
            return view('admin.manageEcom.studio', ['studio' => $studData]);
        }
    }

    public function studActive(Request $req)
    {
        try {
            studio::where('Id', $req->studId)->update(['sActive' => $req->studActive]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function studFeatured(Request $req)
    {
        try {
            studio::where('Id', $req->studId)->update(['sFeatured' => $req->studFeatured]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function addStudio(Request $request)
    {
        if ($request->formType == "update") {
            if ($request->addStudCheck == 'on' && $request->addStudFeaCheck == null) {
                $addStudCheck = 1;
                $addStudFeaCheck = 0;
            } else if ($request->addStudCheck == null && $request->addStudFeaCheck == 'on') {
                $addStudFeaCheck = 1;
                $addStudCheck = 0;
            } else if ($request->addStudCheck == 'on' && $request->addStudFeaCheck == 'on') {
                $addStudCheck = 1;
                $addStudFeaCheck = 1;
            } else {
                $addStudCheck = 0;
                $addStudFeaCheck = 0;
            }
            try {
                DB::table('studios')
                    ->where('Id', $request->studId)
                    ->update([
                        'sActive' => $addStudCheck,
                        'sFeatured' => $addStudFeaCheck
                    ]);
                if ($request->file('studDisplayImg') != null) {
                    $editImg = $request->file('studDisplayImg');
                    $editImageName = strtotime(now()) . rand(11111, 99999) . '-' . $request->catSelect . '-' . $request->brandSelect;
                    $editImageName = Helper::OPImageResize($editImg, $editImageName, 'images/uploads/gallery/',  742, 794, true, 275, 275);
                    DB::table('studios')
                        ->where('Id', $request->studId)
                        ->update([
                            'sImage' => $editImageName['file'],
                            'thumb' => $editImageName['thumb']
                        ]);
                }
                return response()->json(['status' => "success", 'stud_id' => $request->studId, 'formType' => 'update']);
            } catch (Exception $e) {
                return response()->json(['status' => 'exception', 'msg' => $e->getMessage()]);
            }
        } else {
            try {
                if ($request->addStudCheck == 'on' && $request->addStudFeaCheck == null) {
                    $addStudCheck = 1;
                    $addStudFeaCheck = 0;
                } else if ($request->addStudCheck == null && $request->addStudFeaCheck == 'on') {
                    $addStudFeaCheck = 1;
                    $addStudCheck = 0;
                } else if ($request->addStudCheck == 'on' && $request->addStudFeaCheck == 'on') {
                    $addStudCheck = 1;
                    $addStudFeaCheck = 1;
                } else {
                    $addStudCheck = 0;
                    $addStudFeaCheck = 0;
                }
                $stud = new studio;
                $img = $request->file('studDisplayImg');
                $imageName = strtotime(now()) . rand(11111, 99999) . '-' . $request->catSelect . '-' . $request->brandSelect;
                $imageName = Helper::OPImageResize($img, $imageName, 'images/uploads/gallery/',  742, 794, true, 275, 275);

                $stud->sImage = $imageName['file'];
                $stud->thumb = $imageName['thumb'];

                $stud->sActive = $addStudCheck;
                $stud->sFeatured = $addStudFeaCheck;
                $stud->save();
                $stud_id = $stud->id;

                return response()->json(['status' => "success", 'stud_id' => $stud_id, 'formType' => 'add']);
            } catch (Exception $e) {
                return response()->json(['status' => 'exception', 'msg' => $e->getMessage()]);
            }
        }
    }

    public function storeStudImgaes(Request $request)
    {
        $studImagesE = studio::where('Id', $request->studId)->get();
        if (!$studImagesE->isEmpty() && $studImagesE->count() > $request->i) {
            $eImage = substr(strrchr(rtrim($studImagesE[$request->i]->sImage, '/'), '/'), 1);
            $sImage = $request->file('studioImages')->getClientOriginalName();
            if ($sImage == $eImage) {
                $studId = $request->studId;
                return response()->json(['status' => "success", 'imgdata' => $eImage, 'studId exist' => $studId, 'i' => (int)$request->i + 1]);
            } else {
                $stud_images = new studio();
                $imageName = strtotime(now()) . rand(11111, 99999);
                if ($request->file('studioImages')->getClientOriginalExtension() == 'mp4' || $request->file('studioImages')->getClientOriginalExtension() == 'MP4') {
                    $imageName = $imageName . '.' . $request->file('studioImages')->getClientOriginalExtension();
                    $request->file('studioImages')->move('images/uploads/gallery/', $imageName);
                    $stud_images->sImage = 'images/uploads/gallery/' . $imageName;
                } else {
                    $imageName = Helper::OPImageResize($request->file('studioImages'), $imageName, 'images/uploads/gallery/',  742, 794, true, 169, 108);
                    $stud_images->sImage = $imageName['file'];
                    $stud_images->thumb = $imageName['thumb'];
                    $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $request->file('studioImages')->getClientOriginalExtension();
                    $request->file('studioImages')->move('images/uploads/gallery/original/', $imageName);
                    $stud_images->orgImg = '/images/uploads/gallery/original/' . $imageName;
                }
                $stud_images->save();
                return response()->json(['status' => "success", 'imgdata' => $imageName, 'studId added', 'i' => $request->i]);
            }
        } else {
            $stud_images = new studio();

            if ($request->file('studioImages')->getClientOriginalExtension() == 'mp4' || $request->file('studioImages')->getClientOriginalExtension() == 'MP4') {
                $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $request->file('studioImages')->getClientOriginalExtension();
                $request->file('studioImages')->move('images/uploads/gallery/', $imageName);
                $stud_images->sImage = 'images/uploads/gallery/' . $imageName;
            } else {
                $imageName = strtotime(now()) . rand(11111, 99999);
                $imageName = Helper::OPImageResize($request->file('studioImages'), $imageName, 'images/uploads/gallery/',  742, 794, true, 169, 108);
                $stud_images->sImage = $imageName['file'];
                $stud_images->thumb = $imageName['thumb'];

                $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $request->file('studioImages')->getClientOriginalExtension();
                $request->file('studioImages')->move('images/uploads/gallery/original/', $imageName);
                $stud_images->orgImg =  '/images/uploads/gallery/original/' . $imageName;
            }

            $stud_images->save();
            return response()->json(['status' => "success", 'imgdata' => $imageName, 'i' => $request->i]);
        }
    }

    public function studDel(Request $req)
    {
        try {
            $studDB = DB::table('studios')->where('Id', $req->deleteStudio);

            $delImageDB = $studDB->select('orgImg', 'sImage', 'thumb')->first();
            $sImage = $delImageDB->sImage;
            $sTImage = $delImageDB->thumb;
            $sOImage = $delImageDB->orgImg;
            File::exists(($sImage)) ? File::delete(($sImage)) : 'File does not exists.';
            File::exists(($sTImage)) ? File::delete(($sTImage)) : 'File does not exists.';
            File::exists(($sOImage)) ? File::delete(($sOImage)) : 'File does not exists.';

            $studDB->delete();
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => dd($e)]);
        }
    }

    public function delMStud(Request $req)
    {
        try {
            foreach ($req->ids as $deleteStudio) {
                $studDB = DB::table('studios')->where('Id', $deleteStudio);
                $delImageDB = $studDB->select('orgImg', 'sImage', 'thumb')->first();
                $sImage = $delImageDB->sImage;
                $sTImage = $delImageDB->thumb;
                $sOImage = $delImageDB->orgImg;
                File::exists(($sImage)) ? File::delete(($sImage)) : 'File does not exists.';
                File::exists(($sTImage)) ? File::delete(($sTImage)) : 'File does not exists.';
                File::exists(($sOImage)) ? File::delete(($sOImage)) : 'File does not exists.';
                $studDB->delete();
            }

            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => dd($e)]);
        }
    }

    public function imgDelStud(Request $req)
    {
        try {
            $studDetailDB = DB::table('studios')->where('sImage', $req->imgRemoveURL);

            $delImageDB = $studDetailDB->select('orgImg', 'sImage', 'thumb')->first();
            $sImage = $delImageDB->sImage;
            $sTImage = $delImageDB->thumb;
            $pOImage = $delImageDB->orgImg;

            File::exists(($sImage)) ? File::delete(($sImage)) : 'File does not exists.';
            File::exists(($sTImage)) ? File::delete(($sTImage)) : 'File does not exists.';
            File::exists(($pOImage)) ? File::delete(($pOImage)) : 'File does not exists.';

            $studDetailDB->delete();
           
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => dd($e)]);
        }
    }
}
