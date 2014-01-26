<?php
/**
 * Created by JetBrains PhpStorm.
 * User: luissantos
 * Date: 1/26/14
 * Time: 7:40 PM
 * To change this template use File | Settings | File Templates.
 */

namespace PHPOTP\Otp;


use PHPOTP\Authenticator\Authenticator;

class Rfc4226 {

    /**
     * @var Authenticator
     */
    protected $authenticator;


    function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }


    protected function StToNum($binary_data){
        return bindec($binary_data);
    }

    /**
     * @return \PHPOTP\Authenticator\Authenticator
     */
    protected  function getAuthenticator()
    {
        return $this->authenticator;
    }


    protected function generateOtp($counter){

    }

    protected function hmac($counter){

        $auth = $this->getAuthenticator();

        $hmac = $auth->hash($counter);

        $Sbits = substr($hmac,0,1) & 0x0f;

        $Snum = $this->StToNum($Sbits);

        substr($hmac,$Snum,$)

    }


}