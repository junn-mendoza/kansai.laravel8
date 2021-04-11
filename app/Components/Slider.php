<?php
namespace App\Components;
use App\Constants\General;
class Slider extends ApiComponents
{
    public $bannerTitle;
    public $bannerImage;
    public $bannerPosition;
    public $bannerMedium;
    public $bannerDescription;

    /** @var boolean */
    public $bannerSingleLine;
    public $textPosition;
    public $textClass;
    public $textColor;
    
    public function __construct($site, $page)
    {
        $this->setSlider($site, $page);
    }

    private function setSlider($site, $page)
    {
        $slider = $this->callApi(General::SETTINGS, [$site, $page]);       
        $this->bannerTitle = $slider->banner_title;
        $this->bannerImage = $slider->banner;
        $this->bannerPosition = $slider->banner_position;
        $this->bannerDescription = $slider->banner_desc;
        $this->bannerMedium = $slider->banner_medium;
        $this->textPosition = $slider->text_position;
        $this->textClass = $slider->text_class;
        $this->textColor = $slider->text_color;

    }
}

