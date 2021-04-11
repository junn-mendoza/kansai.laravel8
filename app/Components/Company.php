<?php
namespace App\Components;
use App\Models\GlobalKansai;
use App\Constants\General;
class Company extends ApiComponents
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
        
        /** @var \App\Models\GlobalKansai $company*/
        $company = $this->callApi(General::COMPANY);
        $this->name = $company->company;
        $this->address = $company->address;
        $this->telephone = $company->tel;
        $this->email1 = $company->email1;
        $this->email2 = $company->email2;
    }
}

