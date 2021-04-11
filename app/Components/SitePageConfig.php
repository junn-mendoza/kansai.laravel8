<?php
namespace App\Components;
use App\Components\Company;
use App\Components\Navigator;
use App\Constants\General;

class SitePageConfig extends AbstractConfig
{
     /** @var string */
     public $site;

    /** @var string */
    public $page;

    /** @var string */
    public $view;

    /** @var string */
    public $oldPage;

    /** @var string */
    public $title;

    public $settings;

    /** @var \App\Components\Company $company */
    public $company;

    /** @var string */
    public $menuFooter;

    /** @var string */
    public $menuTopBar;

    /** @var string */
    public $menuHeader;

    /** @var \App\Components\Slider $slider */
    public $slider;

    /** @var \App\Models\Contents[] */
    public $contents;

    public $details;
    /**
     * constructor function
     */
    public function __construct($site = General::DEFAULT_SITE, $page = General::DEFAULT_PAGE){
        $this->site = strtolower($site);
        $this->page = $this->oldPage = strtolower($page);        
        $this->setReference();
    }

    private function setReference()
    {       
        
        switch($this->site) {
            case General::SITE_HOMEOWNER:
                /** @var  \App\Components\Homeowner $siteModel */
                $siteModel = new CustomPage();
                $siteModel->checkSiteGroup($this->site, $this->page);
                if($siteModel->page!=null) {
                    $this->page = $siteModel->page;
                    $this->details = $siteModel->productDetails;
                }
                break;
        }
        $this->setSiteComponents();       
    }  
    private function setSiteComponents()
    {
        /** @var \App\Components\Setting $settings */
        $settings = new Setting($this->site, $this->oldPage);
        $this->settings = $settings->settings;
        $this->company = new Company;
        $this->menuFooter = $this->buildHtmlMenuFooter($this->site);
        $this->menuTopBar = $this->buildHtmlMenuTopBar($this->site);
        $this->menuHeader = $this->buildHtmlMenuHeader($this->site);               
        $this->contents = $this->buildContentWithEncryption($this->site, $this->page, $this->oldPage);
        $this->slider = new Slider($this->site, $this->oldPage ); 
        $this->view = $this->site . '.' . $this->page; 
    }   
}

