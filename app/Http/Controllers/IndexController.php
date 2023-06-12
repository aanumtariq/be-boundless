<?php

namespace App\Http\Controllers;
use App\Models\blogs;
use App\Models\packages;
use App\Models\about_cms;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    //       
    public function about()
    {
        $aboutData = about_cms::all();   
        $data = array();
        foreach ($aboutData as $con) {
            $data[$con->var_text] = $con->var_value;
        }      

        $faqs = DB::table('faqs')->select('question','answer')
        ->where('faqActive' , 1)
        ->get();

        return view('Ecomm.about', ['about' => $data, 'faqs' => $faqs]);                  
    }
  
    public function articals()
    {        
        $articals = blogs::all();
        return view('Ecomm.articals')->with(['articals' => $articals]);
    }
    public function packages()
    {             
        $packages = DB::table('packages')
        ->where('pActive', 1)
        ->get();

        return view('Ecomm.packages', ['packages' => $packages]);
    }
    
    public function contactUs()
    {

        return view('Ecomm.contact');
    }

   
    public function home()
    {
        
        $aboutData = about_cms::all();   
        $data = array();
        foreach ($aboutData as $con) {
            $data[$con->var_text] = $con->var_value;
        }      
        
        $blogs = DB::table('blogs')->select('bImage','btitle','bcaption','bdiscription')
        ->where('bFeatured' , 1)->limit(3)->get();
 
        $studios = DB::table('studios')->select('orgImg')
        ->where([['sActive' , 1], ['sFeatured' , 1 ]] )->limit(9)->get();

        return view('index', ['about' => $data, 'blogs' => $blogs, 'studios' => $studios ]);
    }
   
    public function reservation($slug)
    {
        $packageData = packages::where('pSlug', $slug)->select('Id','pBookingId','pName')->first();
        return view('Ecomm.reservation')->with(['packageData' => $packageData]);
    }
}
