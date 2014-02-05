package com.libotp.Authenticator;

import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import java.nio.ByteBuffer;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;

/**
 * Created by luissantos on 2/4/14.
 */
public class Authenticator {

    public static final String HMAC_SHA1_ALGORITHM = "HmacSHA1";

    protected byte[] secret;

    protected String algo;


    public Authenticator(byte[] secret) {
        this(secret,HMAC_SHA1_ALGORITHM);
    }

    public Authenticator(byte[] secret,String algo) {
        this.setSecret(secret);
        this.setAlgo(algo);
    }

    public byte[] getSecret() {
        return secret;
    }

    public void setSecret(byte[] secret) {
        this.secret = secret;
    }

    public String getAlgo() {
        return algo;
    }

    public void setAlgo(String algo) {
        this.algo = algo;
    }

    /**
     *
     * @param data
     * @return
     * @throws NoSuchAlgorithmException
     * @throws InvalidKeyException
     */
    public byte[] hash(byte[] data) throws NoSuchAlgorithmException, InvalidKeyException {

        SecretKeySpec signingKey = new SecretKeySpec(getSecret(), HMAC_SHA1_ALGORITHM );

        Mac mac = Mac.getInstance(HMAC_SHA1_ALGORITHM);
        mac.init(signingKey);


        return mac.doFinal(data);
    }

    /**
     *
     * @param data
     * @return
     * @throws NoSuchAlgorithmException
     * @throws InvalidKeyException
     */
    public byte[] hash(String data) throws NoSuchAlgorithmException, InvalidKeyException {
       return this.hash(data.getBytes());
    }

    /**
     *
     * @param data
     * @return
     * @throws NoSuchAlgorithmException
     * @throws InvalidKeyException
     */
    public byte[] hash(Integer data) throws NoSuchAlgorithmException, InvalidKeyException {

        byte[] integer_data =  ByteBuffer.allocate(4).putInt(data).array();

               
        return this.hash(integer_data);
    }


}
