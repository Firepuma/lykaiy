<?php
if (!defined('IN_XIAOCMS')) exit();

class image
{

    public function checkcode($width = 60, $height = 24, $verifyName = 'checkcode')
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $code = "ABCDEFGHKLMNPRSTUVWYZ23456789";
        $length = 4;
        $randval = '';
        for ($i = 0; $i < $length; $i++) {
            $char = $code{rand(0, strlen($code) - 1)};
            $randval .= $char;
        }
        $_SESSION[$verifyName] = strtolower($randval);
        $width = ($length * 10 + 10) > $width ? $length * 10 + 10 : $width;
        $im = imagecreate($width, $height);
        $backColor = imagecolorallocate($im, 255, 255, 255);
        $borderColor = imagecolorallocate($im, 255, 255, 255);
        @imagefilledrectangle($im, 0, 0, $width - 1, $height - 1, $backColor);
        @imagerectangle($im, 0, 0, $width - 1, $height - 1, $borderColor);
        $fontcolor = imagecolorallocate($im, rand(0, 200), rand(0, 120), rand(0, 120));
        for ($i = 0; $i < $length; $i++) {
            $fontsize = 5;
            $x = floor($width / $length) * $i + 5;
            $y = rand(0, $height - 15);
            imagechar($im, $fontsize, $x, $y, $randval{$i}, $fontcolor);
        }
        self::output($im, 'png');
    }

    public function thumb($image, $thumbname, $maxWidth = 200, $maxHeight = 50, $interlace = true)
    {
        $info = self::getImageInfo($image);
        if ($info !== false) {
            $srcWidth = $info['width'];
            $srcHeight = $info['height'];
            $type = strtolower($info['type']);
            $interlace = $interlace ? 1 : 0;
            unset($info);
            $scale = min($maxWidth / $srcWidth, $maxHeight / $srcHeight);
            if ($scale >= 1) {
                $width = $srcWidth;
                $height = $srcHeight;
            } else {
                $width = (int)($srcWidth * $scale);
                $height = (int)($srcHeight * $scale);
            }
            $createFun = 'ImageCreateFrom' . ($type == 'jpg' ? 'jpeg' : $type);
            $srcImg = $createFun($image);
            if ($type != 'gif' && function_exists('imagecreatetruecolor')) {
                $thumbImg = imagecreatetruecolor($width, $height);
            } else {
                $thumbImg = imagecreate($width, $height);
            }
            if (function_exists("ImageCopyResampled")) {
                imagecopyresampled($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
            } else {
                imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $width, $height, $srcWidth, $srcHeight);
            }
            if ('gif' == $type || 'png' == $type) {
                $background_color = imagecolorallocate($thumbImg, 0, 255, 0);
                imagecolortransparent($thumbImg, $background_color);
            }
            if ('jpg' == $type || 'jpeg' == $type) {
                imageinterlace($thumbImg, $interlace);
            }
            $dir = dirname($thumbname);
            if (!is_dir($dir)) mkdirs($dir);
            $imageFun = 'image' . ($type == 'jpg' ? 'jpeg' : $type);
            $imageFun($thumbImg, $thumbname);
            imagedestroy($thumbImg);
            imagedestroy($srcImg);
            return $thumbname;
        }
        return false;
    }

    static public function watermark($image, $waterPos = 5)
    {
        $water = CORE_PATH . 'img/watermark/watermark.png';
        if (!file_exists($image) || !file_exists($water)) return false;
        $imageInfo = self::getImageInfo($image);
        $image_w = $imageInfo['width'];
        $image_h = $imageInfo['height'];
        $imageFun = "imagecreatefrom" . $imageInfo['type'];
        $image_im = $imageFun($image);
        $waterInfo = self::getImageInfo($water);
        $w = $water_w = $waterInfo['width'];
        $h = $water_h = $waterInfo['height'];
        $waterFun = "imagecreatefrom" . $waterInfo['type'];
        $water_im = $waterFun($water);

        switch ($waterPos) {
            case 0:
                $posX = rand(0, ($image_w - $w));
                $posY = rand(0, ($image_h - $h));
                break;
            case 1:
                $posX = 0;
                $posY = 0;
                break;
            case 2:
                $posX = ($image_w - $w) / 2;
                $posY = 0;
                break;
            case 3:
                $posX = $image_w - $w;
                $posY = 0;
                break;
            case 4:
                $posX = 0;
                $posY = ($image_h - $h) / 2;
                break;
            case 5:
                $posX = ($image_w - $w) / 2;
                $posY = ($image_h - $h) / 2;
                break;
            case 6:
                $posX = $image_w - $w;
                $posY = ($image_h - $h) / 2;
                break;
            case 7:
                $posX = 0;
                $posY = $image_h - $h;
                break;
            case 8:
                $posX = ($image_w - $w) / 2;
                $posY = $image_h - $h;
                break;
            case 9:
                $posX = $image_w - $w;
                $posY = $image_h - $h;
                break;
            default:
                $posX = rand(0, ($image_w - $w));
                $posY = rand(0, ($image_h - $h));
                break;
        }
        imagealphablending($image_im, true);
        imagecopy($image_im, $water_im, $posX, $posY, 0, 0, $water_w, $water_h);
        $bulitImg = "image" . $imageInfo['type'];
        $bulitImg($image_im, $image);
        $waterInfo = $imageInfo = null;
        imagedestroy($image_im);
    }

    static protected function getImageInfo($img)
    {
        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $imageSize = filesize($img);
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "size" => $imageSize,
                "mime" => $imageInfo['mime']
            );
            return $info;
        } else {
            return false;
        }
    }

    static protected function output($im, $type = 'png', $filename = '')
    {
        header("Content-type: image/" . $type);
        $ImageFun = 'image' . $type;
        if (empty($filename)) {
            $ImageFun($im);
        } else {
            $ImageFun($im, $filename);
        }
        imagedestroy($im);
        exit;
    }
	
}