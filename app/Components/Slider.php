<?php
namespace App\Components;

use App\Models\PartialSiteContents;

class Slider
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
        $sliderModel = new PartialSiteContents;
        /** @var \App\Models\PartialSiteContents  $slider*/
        $slider = $sliderModel->where('site',$site)->where('page',$page)->get();        
        $this->bannerTitle = $slider[0]->banner_title;
        $this->bannerImage = $slider[0]->banner;
        $this->bannerPosition = $slider[0]->banner_position;
        $this->bannerDescription = $slider[0]->banner_desc;
        $this->bannerMedium = $slider[0]->banner_medium;
        $this->textPosition = $slider[0]->text_position;
        $this->textClass = $slider[0]->text_class;
        $this->textColor = $slider[0]->text_color;

    }
}

