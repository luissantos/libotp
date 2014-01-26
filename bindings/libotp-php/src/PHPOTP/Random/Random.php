<?php

namespace PHPOTP\Random;


class Random{


    /**
     *
     * Generates a set o random bytes
     *
     * @param int $bytes
     *
     * @return null|string
     */
    public function generateRandomBytes($bytes){


        $data = null;

        $fp = fopen('/dev/urandom','rb');
        if ($fp !== FALSE) {
            $data =  fread($fp,$bytes);
            fclose($fp);
        }

        return $data;
    }
	

}