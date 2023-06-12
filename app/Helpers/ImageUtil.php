<?php 

namespace App\Helpers;
use DB;
use App\Helpers\Resize;
class ImageUtil extends Helper
{
  public static function getHref($imageId,$height,$width){
    if(!empty($imageId)){
      if(intval($imageId)>0){
        $img_path = parent::OneColData('imagetable',"img_path","id={$imageId}");
      } else {
        $img_path = $imageId;
      }
      if($img_path){
        $imageName = $imageId.'-'.$height.'x'.$width;
        $extension = strtolower(strrchr($img_path, '.'));
        $image_returning = 'Uploads/resized/'.$imageId.'/'.$imageName.$extension;
        $fileCheck = public_path($image_returning);
        /*creating directory according to id if not exist*/
        $image_returning_id_directory = public_path('Uploads/resized/'.$imageId);
        if(!file_exists($image_returning_id_directory)){
          mkdir($image_returning_id_directory);
        }
        /*creating directory according to id  if not exist end*/
        if(!file_exists($fileCheck)){
          /*Generating Image*/
          $image = public_path($img_path);
          $resizeObj = new Resize($image);
          $resizeObj->resizeImage($height,$width,'exact');
          $resizeObj->saveImage($fileCheck,45,$extension,'');
          /*Generating Image End*/
        }
        return asset($image_returning);
      }
    }
  }
}