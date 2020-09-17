<?php


namespace App\Http\Controllers\Imagick;
use Illuminate\Support\Facades\Storage;

class ImageImagick
{
    public $_image = NULL;
    public $_output = NULL;
    public $_prefix = 'IMG';
    private $_width = NULL;
    private $_height = NULL;

    public static function factory($image, $output)
    {
        return new ImageImagick($image, $output);
    }

    public function __construct($image, $output)
    {
        if(!empty($image))
        {
            $this->_image = new \Imagick();
            $this->_image->readImageBlob($image);
            $this->_output = $output;
            $this->_width = $this->_image->getImageWidth();
            $this->_height = $this->_image->getImageHeight();
        }
        else
        {
            throw new Exception('File not exit. Aborting.');
        }
    }
    public function output()
    {
        Storage::disk('local')->put($this->_output, $this->_image->getImageBlob());
    }

    public function info()
    {
        $filename = $this->_image->getFilename();
        $imageWidth = $this->_image->getImageWidth();
        $imageHeight = $this->_image->getImageHeight();
        $format = $this->_image->getImageFormat();
        $url = $this->_image->getImageBackgroundColor();
        return array(
          'Tên file' => $filename,
            'Chiều dài' => $imageWidth,
            'Chiều cao' => $imageHeight,
            'Dạng file' => $format,
            'url' => $url,
        );
    }
    public function border( $color = 'black', $width = 20,$height =20)
    {
        $colors = new \ImagickPixel();
        $colors->setColor($color);
        $this->_image->borderImage($colors,$width,$height);//Bao quanh hình ảnh bằng đường viền
    }
    public function gotham() //ảnh đen trắng
    {
        $this->_image->modulateImage(120,10,100);//Kiểm soát độ sáng, độ bão hòa và màu sắc
        $this->_image->colorizeImage('#222b6d',20,true);//Trộn màu tô với hình ảnh
        $this->_image->gammaImage(0.5);//Gamma chỉnh sửa hình ảnh
    }
    public function rotateImage($color,$rotate){
        $this->_image->rotateImage($color, $rotate);
    }

}
