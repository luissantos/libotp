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

class AuthenticatorTest extends \PHPUnit_Framework_TestCase {


    public function testHash(){

        $auth = new Authenticator("asdasdasdaasd");


        $data = $auth->hash("teste");


        $this->assertNotNull($data);


    }

}
