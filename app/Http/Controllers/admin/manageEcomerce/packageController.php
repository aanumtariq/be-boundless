<?php

namespace App\Http\Controllers\admin\manageEcomerce;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\packages;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class packageController extends Controller
{
     /* Package */
    public function getPackage(Request $req)
    {
        if ($req->has('getPackageId')) {
            $packageData = packages::where('Id', $req->getPackageId)->first();            
            return response()->json(['packageData' => $packageData]);
        } else {

            $packageData = packages::all();           
            return view('admin.manageEcom.packages', ['packages' => $packageData]);
        }
    }

    public function packageActive(Request $req)
    {
        try {
            packages::where('Id', $req->packageId)->update(['pActive' => $req->packageActive]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function packageFeatured(Request $req)
    {
        try {
            packages::where('Id', $req->packageId)->update(['pFeatured' => $req->packageFeatured]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function addPackage(Request $request)
    {
        if ($request->formType == "update") {
            if ($request->addPackageCheck == 'on' && $request->addPackageFeaCheck == null) {
                $addPackageCheck = 1;
                $addPackageFeaCheck = 0;
            } else if ($request->addPackageCheck == null && $request->addPackageFeaCheck == 'on') {
                $addPackageFeaCheck = 1;
                $addPackageCheck = 0;
            } else if ($request->addPackageCheck == 'on' && $request->addPackageFeaCheck == 'on') {
                $addPackageCheck = 1;
                $addPackageFeaCheck = 1;
            } else {
                $addPackageCheck = 0;
                $addPackageFeaCheck = 0;
            }
            try {
                DB::table('packages')
                    ->where('Id', $request->packageId)
                    ->update([                       
                        'pName' => $request->packageName,
                        'pSlug' => $this->getSlug($request->packageName),
                        'pDescription' => $request->packageDescript,                       
                        'pBookingId' => $request->packageModelNo,
                        'noOfDays' => $request->packageNoOfDays,
                        'pPrice' => $request->packagePrice,
                        'discount' => $request->packageDiscount,                       
                        'pActive' => $addPackageCheck,
                        'pFeatured' => $addPackageFeaCheck
                    ]);
                if ($request->file('packageDisplayImg') != null) {
                    $editImg = $request->file('packageDisplayImg');
                    $editImageName = strtotime(now()) . rand(11111, 99999) . '-' . $this->getSlug($request->packageName);
                    $editImageName = Helper::OPImageResize($editImg, $editImageName, 'images/uploads/packagesImg/',  742, 794, true, 275, 275);
                   
                    DB::table('packages')
                        ->where('Id', $request->packageId)
                        ->update([
                            'pImage' => $editImageName['file'],
                            'thumb' => $editImageName['thumb']
                        ]);
                }
                return response()->json(['status' => "success", 'package_id' => $request->packageId, 'formType' => 'update']);
            } catch (Exception $e) {
                return response()->json(['status' => 'exception', 'msg' => $e->getMessage()]);
            }
        } else {
            try {
                if ($request->addPackageCheck == 'on' && $request->addPackageFeaCheck == null) {
                    $addPackageCheck = 1;
                    $addPackageFeaCheck = 0;
                } else if ($request->addPackageCheck == null && $request->addPackageFeaCheck == 'on') {
                    $addPackageFeaCheck = 1;
                    $addPackageCheck = 0;
                } else if ($request->addPackageCheck == 'on' && $request->addPackageFeaCheck == 'on') {
                    $addPackageCheck = 1;
                    $addPackageFeaCheck = 1;
                } else {
                    $addPackageCheck = 0;
                    $addPackageFeaCheck = 0;
                }
                $package = new packages;
                $package->pName = $request->packageName;
                $package->pSlug =  $this->getSlug($request->packageName);
                $package->pDescription = $request->packageDescript;               
                $package->pBookingId = $request->packageModelNo;
                $package->noOfDays = $request->packageNoOfDays;
                $package->pPrice = $request->packagePrice;
                $package->discount = $request->packageDiscount;
               
                $img = $request->file('packageDisplayImg');
                $imageName = strtotime(now()) . rand(11111, 99999) . '-' . $this->getSlug($request->packageName);
                $imageName = Helper::OPImageResize($img, $imageName, 'images/uploads/packagesImg/',  742, 794, true, 275, 275);


                $package->pImage = $imageName['file'];
                $package->thumb = $imageName['thumb'];

                $package->pActive = $addPackageCheck;
                $package->pFeatured = $addPackageFeaCheck;
                $package->save();
                $package_id = $package->id;

                return response()->json(['status' => "success", 'package_id' => $package_id, 'formType' => 'add']);
            } catch (Exception $e) {
                return response()->json(['status' => 'exception', 'msg' => $e->getMessage()]);
            }
        }
    }  

    public function packageDel(Request $req)
    {
        try {
            $packageDB = DB::table('packages')->where('Id', $req->deletePackage);
           
            $delImageDB = $packageDB->select('pImage', 'thumb')->first();
            $pImage = $delImageDB->pImage;
            $pTImage = $delImageDB->thumb;
            File::exists(public_path($pImage)) ? File::delete(public_path($pImage)) : 'File does not exists.';
            File::exists(public_path($pTImage)) ? File::delete(public_path($pTImage)) : 'File does not exists.';           
            $packageDB->delete();          

            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => dd($e)]);
        }
    }

    public function delMPackage(Request $req)
    {
        try {
            foreach ($req->ids as $deletePackage) {
                $packageDB = DB::table('packages')->where('Id', $deletePackage);

                $delImageDB = $packageDB->select('pImage', 'thumb')->first();
                $pImage = $delImageDB->pImage;
                $pTImage = $delImageDB->thumb;
                File::exists(public_path($pImage)) ? File::delete(public_path($pImage)) : 'File does not exists.';
                File::exists(public_path($pTImage)) ? File::delete(public_path($pTImage)) : 'File does not exists.';


                $packageDB->delete();
              
            }

            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => dd($e)]);
        }
    }

   




}
