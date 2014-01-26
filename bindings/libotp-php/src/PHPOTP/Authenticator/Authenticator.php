<?php

namespace PHPOTP\Authenticator;


class Authenticator{


	/**
	* @var mixed
	*/
	protected $secret;

    /**
    * @var string
    */
	protected $algo;

	public function __construct($secret,$hash_algo = "sha1"){
		
		$this->setSecret($secret);

		$this->setAlgo($hash_algo);

	}


	/**
	*
	* @param mixed $data
	* @return mixed binary data
	*/
	public function hash($data){
		return hash_hmac($this->getAlgo(), $data , $this->getSecret(),true);
	}




    /**
     * Gets the value of secret.
     *
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }
    
    /**
     * Sets the value of secret.
     *
     * @param mixed $secret the secret
     *     
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }





    /**
     * Gets the value of algo.
     *
     * @return string
     */
    public function getAlgo()
    {
        return $this->algo;
    }
    
    /**
     * Sets the value of algo.
     *
     * @param string $algo the algo
     *
     */
    public function setAlgo($algo)
    {
        $this->algo = $algo;
    }
}