<?php
namespace App\Components;
use App\Constants\General;
class Navigator
{
    /**********************************************************************************
	navigation function is creatinng an array using the parameter Homeowner, Professional 
				or corporate and injecting it to MakeMenu to build the actual navigation menu
	**********************************************************************************/
    private $url;
	private $site;
	
	public function menuHeaderNavigation($site)
	{	
		$this->site = $site;   
        $menuHeaderContents = '';
		switch(strtolower($site)) {			
		 	case "homeowner":			    
			  	$menuHeaderContents = __(General::MENU_OWNER_HEADER);
		 		break;
		 	case "corporate":			    
                $menuHeaderContents = __(General::MENU_CORPORATE_HEADER);
	 			break;
		 	case "professional":			    
         		$menuHeaderContents = __(General::MENU_PROFESSIONAL_HEADER);	
		 		break;			
		}
		 return $this->createMenuHeader($menuHeaderContents);
	}
    /**
     * Undocumented function
     *
     * @param array $menuHeaderContents
     * @param integer $level
     * @return string
     */
    public function createMenuHeader($items, $level = 0) 
	{
		$this->url = url('/').'/'.strtolower($this->site).'/'; 		
	    $ret = "";
	    $indent = str_repeat(" ", $level * 2);
	    $ret .= ($level==0? sprintf("%s<ul class='nav navbar-nav'>\n", $indent) :  sprintf("%s<ul class='dropdown-menu animated fadeIn'>\n", $indent));
	    $indent = str_repeat(" ", ++$level * 2);
	    foreach ($items as $key => $value) {
	         if (!is_numeric($value) && isset($value['subMenu'])) {
	            $ret .= sprintf("%s<li class='dropdown '><a href='".$this->url.$value['url']."' class='dropdown-toggle js-activated 2ndlevel active2' data-type='menu' onclick='clickMenu()'>%s</a>", $indent, $value['title']);
	        	
	         }
	         if (isset($value['subMenu'])) {
	             $ret .= "\n";
                 $subMenu = $value['subMenu'];
	             $ret .= $this->createMenuHeader( $subMenu, $level + 1);
	             $ret .= $indent;
	         } else if($level>0){
	         	$ret .= sprintf("%s<li class='dropdown-submenu'><a href='".$this->url.$value['url']."' data-type='submenu' onclick='clickMenu()'>%s</a>", $indent,  $value['title']);
	         }
	         $ret .= sprintf("</li>\n", $indent);
	    }
	     if($level==1) {
	     	$ret .= sprintf("<li>\n", $indent);
	    	$ret .= sprintf("%s<ul class='social-top'>\n", $indent);
        	$ret .= sprintf("%s<li><a href='#' id='header-search-button'><i class='icon-search-1' style='display:none;'></i></a>\n", $indent);     
        	$ret .= sprintf("%s</li>\n", $indent); 
        	$ret .= sprintf("%s</ul>\n", $indent);
        	$ret .= sprintf("</li>\n", $indent);	    	
	    }
	    $indent = str_repeat(" ", --$level * 2);
	    $ret .= sprintf("%s</ul>\n", $indent);
        return($ret);      
	}
    public function menuFooterNavigator($site)
    {		
		switch($site)
		{
			case "homeowner":
				$site = __(General::MENU_OWNER_FOOTER);
				break;
			case "professional":
				$site = __(General::MENU_PROFESSIONAL_FOOTER);
				break;		
			case "corporate":
				$site =__(General::MENU_CORPORATE_FOOTER);
				break;	
				
			case "Test":
				return "";
				break;	
		}
		return $site;
	}
}

