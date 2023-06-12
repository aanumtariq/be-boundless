<?php 

   # ========================================================================#
   #  Requires : Requires PHP5, GD library.
   #  Usage Example:
   #                     include("resize_class.php");
   #                     $resizeObj = new resize('images/cars/large/input.jpg');
   #                     $resizeObj -> resizeImage(150, 100, 0);
   #                     $resizeObj -> saveImage('images/cars/large/output.jpg', 100);
   # ========================================================================#
namespace App\Helpers;

        class Resize
        {
            // *** Class variables
            private $image;
            private $width;
            private $height;
            private $imageResized;
            private $extension;

            function __construct($fileName)
            {
                // *** Open up the file
                $this->image = $this->openImage($fileName);

                // *** Get width and height
                $this->width  = imagesx($this->image);
                $this->height = imagesy($this->image);
                $this->extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            }

            ## --------------------------------------------------------
            public function getSize(){
                $height  = imagesx($this->image);
                $width = imagesy($this->image);
                return array('height'=>$height,'width'=>$width);
            }
            private function openImage($file)
            {
                // *** Get extension
                $extension = strtolower(strrchr($file, '.'));
                switch($extension)
                {
                    case '.jpg':
                    case '.jpeg':
                        $img = @imagecreatefromjpeg($file);
                        break;
                    case '.gif':
                        $img = @imagecreatefromgif($file);
                        break;
                    case '.png':
                        $img = @imagecreatefrompng($file);
                        break;
                    default:
                        $img = false;
                        break;
                }
                return $img;
            }

            ## --------------------------------------------------------

            public function resizeImage($newWidth, $newHeight, $option="auto")
            {
                // *** Get optimal width and height - based on $option
                $optionArray = $this->getDimensions($newWidth, $newHeight, $option);

                $optimalWidth  = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];


                // *** Resample - create image canvas of x, y size
                $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
                if ($this->extension === 'png') { 
                    $background = imagecolorallocate($this->imageResized, 0, 0, 0); 
                    imagecolortransparent($this->imageResized, $background); 
                    imagealphablending($this->imageResized, false); 
                    imagesavealpha($this->imageResized, true); 
                } 
                imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);


                // *** if option is 'crop', then crop too
                if ($option == 'crop') {
                    $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
                }
            }

            ## --------------------------------------------------------

            private function getDimensions($newWidth, $newHeight, $option)
            {

               switch ($option)
                {
                    case 'exact':
                        $optimalWidth = $newWidth;
                        $optimalHeight= $newHeight;
                        break;
                    case 'portrait':
                        $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                        $optimalHeight= $newHeight;
                        break;
                    case 'landscape':
                        $optimalWidth = $newWidth;
                        $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                        break;
                    case 'auto':
                        $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
                        $optimalWidth = $optionArray['optimalWidth'];
                        $optimalHeight = $optionArray['optimalHeight'];
                        break;
                    case 'crop':
                        $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
                        $optimalWidth = $optionArray['optimalWidth'];
                        $optimalHeight = $optionArray['optimalHeight'];
                        break;
                }
                return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
            }

            ## --------------------------------------------------------

            private function getSizeByFixedHeight($newHeight)
            {
                $ratio = $this->width / $this->height;
                $newWidth = $newHeight * $ratio;
                return $newWidth;
            }

            private function getSizeByFixedWidth($newWidth)
            {
                $ratio = $this->height / $this->width;
                $newHeight = $newWidth * $ratio;
                return $newHeight;
            }

            private function getSizeByAuto($newWidth, $newHeight)
            {
                if ($this->height < $this->width)
                // *** Image to be resized is wider (landscape)
                {
                    $optimalWidth = $newWidth;
                    $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                }
                elseif ($this->height > $this->width)
                // *** Image to be resized is taller (portrait)
                {
                    $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                    $optimalHeight= $newHeight;
                }
                else
                // *** Image to be resizerd is a square
                {
                    if ($newHeight < $newWidth) {
                        $optimalWidth = $newWidth;
                        $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                    } else if ($newHeight > $newWidth) {
                        $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                        $optimalHeight= $newHeight;
                    } else {
                        // *** Sqaure being resized to a square
                        $optimalWidth = $newWidth;
                        $optimalHeight= $newHeight;
                    }
                }

                return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
            }

            ## --------------------------------------------------------

            private function getOptimalCrop($newWidth, $newHeight)
            {

                $heightRatio = $this->height / $newHeight;
                $widthRatio  = $this->width /  $newWidth;

                if ($heightRatio < $widthRatio) {
                    $optimalRatio = $heightRatio;
                } else {
                    $optimalRatio = $widthRatio;
                }

                $optimalHeight = $this->height / $optimalRatio;
                $optimalWidth  = $this->width  / $optimalRatio;

                return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
            }

            ## --------------------------------------------------------

            private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
            {
                // *** Find center - this will be used for the crop
                $cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
                $cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

                $crop = $this->imageResized;
                //imagedestroy($this->imageResized);

                // *** Now crop from center to exact requested size
                $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
                imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
            }

            ## --------------------------------------------------------

            public function saveImage($savePath=NULL, $imageQuality="100",$extension='',$filters='')
            {
                // *** Get extension
                if($extension==''){
                    $extension = strrchr($savePath, '.');
                    $extension = strtolower($extension);
                }
                switch($extension)
                {
                    case '.jpg':
                    case '.jpeg':
                    case '.png':
                        if (imagetypes() & IMG_JPG) {
                            if(isset($filters['greyScale'])){
                                imagefilter($this->imageResized, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
                            }
                            if(isset($filters['negative'])){
                                imagefilter($this->imageResized, IMG_FILTER_NEGATE); //first, convert to grayscale
                            }
                            if(isset($filters['sketch'])){
                                imagefilter($this->imageResized, IMG_FILTER_MEAN_REMOVAL); //first, convert to grayscale
                            }
                            if(isset($filters['contrast'])){
                                imagefilter($this->imageResized, IMG_FILTER_CONTRAST, $filters['contrast']); //then, apply a full contrast
                            }
                            if(isset($filters['brightness'])){
                                imagefilter($this->imageResized, IMG_FILTER_BRIGHTNESS, $filters['brightness']); //then, apply a full contrast
                            }
                            if(isset($filters['sepia'])){
                                //imagefilter($this->imageResized,IMG_FILTER_GRAYSCALE);
                                //imagefilter($this->imageResized,IMG_FILTER_BRIGHTNESS,-30);
                                imagefilter($this->imageResized,IMG_FILTER_COLORIZE, 90, 55, 30);
                            }
                            if(isset($filters['rgb'])){
                                $red = !empty(explode('x',$filters['rgb'])[0])?explode('x',$filters['rgb'])[0]:NULL;
                                $green = !empty(explode('x',$filters['rgb'])[1])?explode('x',$filters['rgb'])[1]:NULL;
                                $blue = !empty(explode('x',$filters['rgb'])[2])?explode('x',$filters['rgb'])[2]:NULL;
                                $alpha = 127;
                                $opacity = !empty(explode('x',$filters['rgb'])[3])?explode('x',$filters['rgb'])[3]:1;
                                $transparency = 1 - $opacity;
                                if($alpha>1){
                                    $im = imagecreatetruecolor(55, 30);
                                    //$red = imagecolorallocate($im, 255, 0, 0);
                                    $black = imagecolorallocate($im, 0, 0, 0);
                                    imagecolortransparent($im, $black);
                                    imagefilledrectangle($im, 4, 4, 50, 25, $red);
                                }
                                imagealphablending($this->imageResized, false); 
                                imagesavealpha($this->imageResized, true);
                                imagefilter($this->imageResized, IMG_FILTER_COLORIZE, $red,$green,$blue,($alpha*$transparency)); //then, apply a full contrast
                            }
                            if(isset($filters['text'])){
                                $textcolor = imagecolorallocate($this->imageResized, 0, 0, 0);
                                $bg_color = imagecolorallocate($this->imageResized, 255, 255, 255);
                                $offset_x = 100;
                              $offset_y = 50;
                              $dims = imagettfbbox($filters['fontsize'], 0, $filters['fontfile'], $filters['text']);
                              $text_width = $dims[4] - $dims[6] + $offset_x;
                              $text_height = $dims[3] - $dims[5] + $offset_y;
                              imagefilledrectangle($this->imageResized, $offset_x, $offset_y, $text_width+5, $text_height+5, $bg_color);
                              imagettftext($this->imageResized, $filters['fontsize'], 0, $offset_x, $offset_y+40, $textcolor, $filters['fontfile'], $filters['text']);
                                /*imagettftext($this->imageResized,$filters['fontsize'],0,50,200,$textcolor,$filters['fontfile'],$filters['text']); */
                            }
                            //imagefilter($this->imageResized, IMG_FILTER_GRAYSCALE); //first, convert to grayscale
                            //imagefilter($this->imageResized, IMG_FILTER_CONTRAST, 500); //then, apply a full contrast
                            $scaleQuality = round(($imageQuality/100) * 9);
                            $invertScaleQuality = 9 - $scaleQuality;
                            imagepng($this->imageResized, $savePath, $invertScaleQuality);
                            //imagepng(imagecreatefromstring(file_get_contents($filename)), $imageQuality);
                        }
                        break;

                    case '.gif':
                        if (imagetypes() & IMG_GIF) {
                            imagegif($this->imageResized, $savePath);
                        }
                        break;

                    /*case '.png':
                        // *** Scale quality from 0-100 to 0-9
                        $scaleQuality = round(($imageQuality/100) * 9);

                        // *** Invert quality setting as 0 is best, not 9
                        $invertScaleQuality = 9 - $scaleQuality;

                        if (imagetypes() & IMG_PNG) {
                             imagepng($this->imageResized, $savePath, $invertScaleQuality);
                        }
                        break; */

                    // ... etc

                    default:
                        // *** No extension - No save.
                        break;
                }

                imagedestroy($this->imageResized);
            }


            ## --------------------------------------------------------

        }
?>