<?php
/**
 * Created by JetBrains PhpStorm.
 * User: luissantos
 * Date: 1/26/14
 * Time: 7:35 PM
 * To change this template use File | Settings | File Templates.
 */

namespace PHPOTP;


use PHPOTP\Random\Random;

class RandomTest extends \PHPUnit_Framework_TestCase {


    public function testRandomBytes(){


        $random_generator = new Random();

        $data = $random_generator->generateRandomBytes(16);


        $this->assertNotNull($data);

    }

}
