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

    /**
     * @var int
     */
    protected $digit;


    function __construct(Authenticator $authenticator,$digit = 6)
    {
        $this->authenticator = $authenticator;
        $this->digit = $digit;
    }


    protected function StToNum($binary_data){
        return hexdec(bin2hex($binary_data));
    }

    /**
     * @return \PHPOTP\Authenticator\Authenticator
     */
    protected  function getAuthenticator()
    {
        return $this->authenticator;
    }


    public  function generateOtp($counter){

        $hmac = $this->hmac($this->normalizeNumber($counter));

        $SBits = $this->dynamicTruncation($hmac);

        $Snum = $this->StToNum($SBits);


        return $Snum % (pow(10,$this->digit));
    }

    protected function hmac($counter){

        $auth = $this->getAuthenticator();

        return $auth->hash($counter);

    }


    protected function getOffsetBits($string){

        $last_byte = substr($string,-1);

        $last_byte_int = $this->bin2dec($last_byte);


        return $this->dec2bin($last_byte_int & 0x0f);
    }

    public function dynamicTruncation($string){

        $offsetbits = $this->getOffsetBits($string);

        $Offset = $this->StToNum($offsetbits);

        //Let P = String[OffSet]...String[OffSet+3]
        $p = substr($string,$Offset,4);


        /* Return the Last 31 bits of P */
        return $this->dec2bin($this->bin2dec($p) & bindec("01111111111111111111111111111111"));
    }

    /**
     * converts binary data to decimal
     *
     * @param $data
     *
     * @return number
     */
    protected  function  bin2dec($data){
        return hexdec(bin2hex($data));
    }

    /**
     *
     * converts decimal to binary data
     *
     * @param $number
     *
     * @return string
     */
    protected function dec2bin($number){
        $hex = dechex($number);
        $size = strlen($hex);

        return hex2bin(str_pad($hex,($size + ($size % 2)),"0",STR_PAD_LEFT));
    }

    /**
     *
     * Converts integer to binary and add padding zeros
     *
     * @param $number
     *
     * @return string
     */
    protected function normalizeNumber($number){
        return hex2bin(str_pad(dechex($number),"16","0",STR_PAD_LEFT));
    }

}