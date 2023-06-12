<?php

namespace App\Http\Controllers\admin\manageEcomerce;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\blogs;
use App\Models\products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class blogsController extends Controller
{
    //
    public function getBlogs(Request $req)
    {
        if ($req->has('getEditBlog')) {
            $blogData = blogs::where('Id', $req->getEditBlog)->first();
            return response()->json(['blogData' => $blogData]);
        } else {
            $blogsData = blogs::all();
            return view('admin.manageEcom.blogs', ['blogs' => $blogsData]);
        }
    }


    public function blogFeatured(Request $req)
    {
        try {
            blogs::where('Id', $req->blogId)->update(['bFeatured' => $req->blogFeatured]);
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e]);
        }
    }

    public function getViewBlogs(Request $req)
    {
        $blogData = blogs::where('Id', $req->getBlogId)->first();
        $blogDetails = blogs::where('blogId', $req->getBlogId)->where('userId', $blogData->userId)->get();
        if (!$blogDetails->isEmpty()) {
            foreach ($blogDetails as $blogDet) {
                $blogPro[] =  products::where('Id', $blogDet->pId)->first();
            }
        } else {
            $blogPro = '';
        }
        return response()->json(['blogData' => $blogData, 'blogDetails' => $blogDetails, 'blogPro' => $blogPro]);
    }


    public function addBlog(Request $req)
    {
        if ($req->formType == "update") {
            try {
                if ($req->addBlogCheck == 'on') {
                    $addBlogCheck = 1;
                } else {

                    $addBlogCheck = 0;
                }
                $strCat = explode("×", implode("", explode(",", $req->categories)));
                $strCat = array_splice($strCat, 1);
                $strCat = implode(", ", $strCat);
                DB::table('blogs')
                    ->where('Id', $req->bId)
                    ->update([
                        'btitle' => $req->blogName,
                        'bSlug' => $this->getSlug($req->blogName),
                        'bcaption' => $req->caption,
                        'bdiscription' => $req->descripton,
                        'bcats' => $strCat,
                        'btags' => $req->tags,
                        'bauthor' => "Gems Expert",
                        'bFeatured' => $addBlogCheck,
                    ]);
                if ($req->file('blogDisplayImg') != null) {
                    $editImg = $req->file('blogDisplayImg');
                    // $editImageName = strtotime(now()) . rand(11111, 99999) . '-' . $req->blogName . '.' . $editImg->getClientOriginalExtension();
                    // $req->file('blogDisplayImg')->move('images/uploads/productsImg/', $editImageName);
                    $editImageName = strtotime(now()) . rand(11111, 99999) . '-' . $this->getSlug($req->blogName);
                    $editImageName = Helper::OPImageResize($editImg, $editImageName, 'images/uploads/productsImg/', 400, 400, true, 370, 240);

                    DB::table('blogs')
                        ->where('Id', $req->bId)
                        ->update([
                            'bImage' => $editImageName['file'],
                            'thumb' => $editImageName['thumb']
                        ]);
                }
                return response()->json(["success" => "Blog Updated"]);
            } catch (Exception $e) {
                return response()->json(dd($e));
            }
        } else {
            try {
                if ($req->addBlogCheck == 'on') {
                    $addBlogCheck = 1;
                } else {

                    $addBlogCheck = 0;
                }
                $blogAddDB = new blogs();
                $blogAddDB->btitle    = $req->blogName;
                $blogAddDB->bSlug    = $this->getSlug($req->blogName);
                $blogAddDB->bcaption = $req->caption;
                $blogAddDB->bdiscription = $req->descripton;
                $strCat = explode("×", implode("", explode(",", $req->categories)));
                $strCat = array_splice($strCat, 1);
                $strCat = implode(", ", $strCat);
                $blogAddDB->bcats = $strCat;
                $blogAddDB->btags = $req->tags;
                $blogAddDB->bauthor    = "Gems Expert";
                $img = $req->file('blogDisplayImg');
                // $imageName = strtotime(now()) . rand(11111, 99999) . '-' . $req->blogName . '.' . $img->getClientOriginalExtension();
                // $req->file('blogDisplayImg')->move('images/uploads/productsImg/', $imageName);
                // $blogAddDB->bImage = 'images/uploads/productsImg/' . $imageName;
                $imageName = strtotime(now()) . rand(11111, 99999) . '-' . $this->getSlug($req->blogName);
                $imageName = Helper::OPImageResize($img, $imageName, 'images/uploads/productsImg/', 400, 400, true, 370, 240);

                $blogAddDB->bImage = $imageName['file'];
                $blogAddDB->thumb = $imageName['thumb'];
                $blogAddDB->bFeatured = $addBlogCheck;
                $blogAddDB->save();
                return response()->json(["success" => "Blog Added"]);
            } catch (Exception $e) {
                return response()->json(dd($e));
            }
        }
    }

    public function blogDel(Request $req)
    {
        try {
            $blogDBDel = DB::table('blogs')->where('Id', $req->bId);

            $bImage = $blogDBDel->select('bImage')->first();
            $bImage = $bImage->bImage;
            $bTImage = $blogDBDel->select('thumb')->first();
            $bTImage = $bTImage->thumb;

            File::exists(($bImage)) ? File::delete(($bImage)) : 'File does not exists.';
            File::exists(($bTImage)) ? File::delete(($bTImage)) : 'File does not exists.';

            $blogDBDel->delete();

            return response()->json(['message' => 'Blog Deleted']);
        } catch (Exception $e) {
            return response()->json(dd($e));
        }
    }
}
