<?php
namespace App\Components;
use App\Models\PartialSiteContents;
class Setting
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
        $setting = PartialSiteContents::where('site',ucwords($site))->where('page',$page)->get()->first();              
        return $setting;
    }
}

