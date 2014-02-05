package com.libotp.Otp;

import com.libotp.Authenticator.Authenticator;

import java.nio.ByteBuffer;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;
import java.util.Arrays;

/**
 * Created by luissantos on 2/4/14.
 */
public class Rfc4226 {


    protected Authenticator authenticator;

    protected Integer digits;

    public Rfc4226(Authenticator authenticator, Integer digits) {
        this.authenticator = authenticator;
        this.digits = digits;
    }

    public Rfc4226(Authenticator authenticator) {
        this(authenticator,6);
    }

    public Authenticator getAuthenticator() {
        return authenticator;
    }

    public void setAuthenticator(Authenticator authenticator) {
        this.authenticator = authenticator;
    }

    public Integer getDigits() {
        return digits;
    }

    public void setDigits(Integer digits) {
        this.digits = digits;
    }


    protected Integer stToNum(byte[] data){
        return ByteBuffer.wrap(data).getInt();
    }

    public Integer generateOtp(Integer counter){

        return 0;
    }

    protected byte[] hmac(Integer counter) throws InvalidKeyException, NoSuchAlgorithmException {
        return authenticator.hash(counter);
    }

    protected byte[] getOffsetBits(byte[] data){

        byte offset = data[data.length-1];

        return new byte[]{ (byte)(offset & 0x0f) };

    }

    /*public  function generateOtp($counter){

        $hmac = $this->hmac($this->normalizeNumber($counter));

        $SBits = $this->dynamicTruncation($hmac);

        $Snum = $this->StToNum($SBits);


        return $Snum % (pow(10,$this->digit));
    }*/


    public byte[] dynamicTruncation(byte[] data){

        byte[] offsetbits = this.getOffsetBits(data);

        int Offset = this.stToNum(offsetbits);

        byte p[] = Arrays.copyOfRange(data,Offset,Offset+3);

        /* Return the Last 31 bits of P */
        return  this.intToByteArray(this.ByteArraytoInt(p) & 0x7FFFFFFF);
    }

    protected byte[] intToByteArray(int value){
        return ByteBuffer.allocate(4).putInt(value).array();
    }

    protected int ByteArraytoInt(byte[] data){
        return ByteBuffer.wrap(data).getInt();
    }

}
