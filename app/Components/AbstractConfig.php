<?php
namespace App\Components;
use App\Models\Contents;
Abstract class AbstractConfig
{
 /**
     * buildHtmlMenuFooter function
     *
     * @param string $site
     * @return void
     */
    protected function buildHtmlMenuFooter($site) {        
        /** @var \App\Components\Navigator $menuFooter  */
        $menuFooter = new Navigator();
        $rowFooter = $menuFooter->menuFooterNavigator($site);
        $result = '<ul class="arrow">'.PHP_EOL;
        foreach($rowFooter as $key => $value) {
            $result .= "<li><a href=" . $key . ">" . $value . "</a> </li>".PHP_EOL;
        }       
        return $result .= '</ul">';
    }
    /**
     * buildHtmlMenuTopBar function
     *
     * @param string $site
     * @return void
     */
    protected function buildHtmlMenuTopBar($site)
    {
        $result = '<ul style="margin:0px; padding:0px" class="n1">'.PHP_EOL;
        $sites = __('menu.menuTopBar');
        foreach($sites as $rowSite)
        {
            $activeClass = ($site == strtolower($rowSite)?'class="active"':'');
            $result .= '<li style="margin:0px; padding:0px; cursor:pointer">'. PHP_EOL;
            $result .= '<i class="icon-stop"></i>';
            $result .= '<a href="'. url('/') . '/'. strtolower($rowSite).'"  target="_self" '.$activeClass.'>';
            $result .= '<span class="spacer">&nbsp;&nbsp;</span> '. strtoupper($rowSite). '<span class="spacer">&nbsp;&nbsp;</span></a></li>'.PHP_EOL;
        }
        return $result .= "</ul>";       
    }
    /**
     * buildHtmlMenuHeader function
     *
     * @param [type] $site
     * @return void
     */
    protected function buildHtmlMenuHeader($site)
    {
        $navigator = new Navigator();
	   	return $navigator->menuHeaderNavigation($site);
    }
    /**
     * buildContentWithEncryption function
     *
     * @param [type] $site
     * @param [type] $page
     * @return void
     */
    protected function buildContentWithEncryption($site = null, $page = null)
    {        
        /** @var  \App\Models\Contents[] $result*/
        $result = [];
        $contents = Contents::where('site', $site)->where('page',($page == 'landingpage'?'':$page) )->orderBy('order')->get();
        foreach($contents ?? [] as $content)
        {
            $salt = (($content->id * 123456789 * 5678)/956783);
            $content['external_id'] = base64_encode($salt);
            $content->id;
            $result[] = $content;
        }                
        return $result;
    }
}

