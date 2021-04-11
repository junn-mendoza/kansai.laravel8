<?php
namespace App\Components;
use App\Constants\General;

class CustomPage extends ApiComponents
{
    /** @var string $page*/
    public $page;
    public $oldpage;
    public $productDetails;
    public function checkSiteGroup($site, $page)
    {        
        $this->oldpage = $page;
        $paintCombine = array_merge(General::PaintGroup01, General::PaintGroup02);
        if(isset($paintCombine[$page])) {            
            $this->page = General::PAGE_COLOR_GROUP;                        
        }
        else if(isset(General::TrendPaint[$page])){
            $this->page = General::PAGE_TREND_GROUP;
        }
        if($this->page!==null) {
            $this->paintData($site, $this->page,  $page);

        }
    }
    private function paintData($site, $current_page,$old_page)
    {
        $includePaint = ($site==General::SITE_HOMEOWNER)? General::PaintGroup01: General::PaintGroup03;    

        switch($current_page)
        {
            case General::PAGE_COLOR_GROUP: 
                if(isset($includePaint[$old_page]))
                {
                    $this->productDetails = $this->callApi(General::COLORS,[$this->oldpage]);                     
                }
                else
                {
                    $this->productDetails = $this->callApi(General::PRODUCTS,[$this->oldpage]);
                }
                break;
            case General::PAGE_TREND_GROUP:
                $this->productDetails = $this->callApi(General::TRENDS,[$this->oldpage]);
                break;
        }
    }
}

