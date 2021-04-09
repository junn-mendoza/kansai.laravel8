<?php
namespace App\Components;
use App\Models\GlobalKansai;
use App\Constants\General;
class Company
{
    public $name;    
    public $address;
    public $telephone;
    public $email;
    public $emil2;

    public function __construct($countryCode = General::DEFAULT_COUNTRY_CODE)
    {
        $this->setSiteCountry($countryCode);
    }
    private function setSiteCountry($countryCode)
    {
        $siteCountryModel = GlobalKansai::where('country_code', $countryCode)->get();
        $this->name = $siteCountryModel[0]->company;
        $this->address = $siteCountryModel[0]->address;
        $this->telephone = $siteCountryModel[0]->tel;
        $this->email1 = $siteCountryModel[0]->email1;
        $this->email2 = $siteCountryModel[0]->email2;
    }
}

