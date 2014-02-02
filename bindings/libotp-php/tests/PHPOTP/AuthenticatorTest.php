<?php
/**
 * Created by JetBrains PhpStorm.
 * User: luissantos
 * Date: 1/26/14
 * Time: 7:10 PM
 * To change this template use File | Settings | File Templates.
 */

namespace PHPOTP;


use PHPOTP\Authenticator\Authenticator;
use PHPOTP\Otp\Rfc4226;

class AuthenticatorTest extends \PHPUnit_Framework_TestCase {


    public function testHash(){

        $auth = new Authenticator("asdasdasdaasd");


        $data = $auth->hash("teste");


        $this->assertNotNull($data);


    }
    
    
    public function testHotp(){

        $auth = new Authenticator("12345678901234567890");

        $hotp = new Rfc4226($auth);

        $testes = array(
            755224,
            287082,
            359152,
            969429,
            338314,
            254676,
            287922,
            162583,
            399871,
            520489
        );


        foreach($testes as $index => $value){
            $this->assertEquals($value,$hotp->generateOtp($index));
        }

    }

}
