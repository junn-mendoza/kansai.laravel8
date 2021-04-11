<?php
namespace App\Components;
use App\Constants\General;
class Setting extends ApiComponents
{
    /** @var  App\Models\PartialSiteContents*/
    public $settings;

    public function __construct($site, $page)
    {        
        $this->settings = $this->getSettings($site, $page);
    } 
    /**
     * getSettings function
     *
     * @param string $site
     * @param string $page
     * @return \App\Models\PartialSiteContents
     */
    private function getSettings($site, $page)
    {
        $setting = $this->callApi(General::SETTINGS,[$site, $page]);              
        return $setting;
    }
}

