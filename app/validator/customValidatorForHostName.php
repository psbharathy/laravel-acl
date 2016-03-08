<?php

namespace App\validator;

use Illuminate\Validation\Validator as IlluminateValidator;

class customValidatorForHostName extends IlluminateValidator
{
    private $_custom_messages = array(
        "state_code" => "The :attribute should contain first 2 letters(First Character Should be in Capital) of state code, 5 letters(First Character Should be in Capital) of station name, 3 letters(First Character Should be in Capital) of counter type,
                    first letter(Should be in Capital) of Bay Location Code, '-' after Bay Location Code, counter number at the end. (Ex: KaBangaPrsF-01).",
        "station_name" => "The :attribute should contain first 2 letters(First Character Should be in Capital) of state code, 5 letters(First Character Should be in Capital) of station name, 3 letters(First Character Should be in Capital) of counter type,
                    first letter(Should be in Capital) of Bay Location Code, '-' after Bay Location Code, counter number at the end. (Ex: KaBangaPrsF-01).",
        "counter_type" => "The :attribute should contain first 2 letters(First Character Should be in Capital) of state code, 5 letters(First Character Should be in Capital) of station name, 3 letters(First Character Should be in Capital) of counter type,
                    first letter(Should be in Capital) of Bay Location Code, '-' after Bay Location Code, counter number at the end. (Ex: KaBangaPrsF-01).",
        "bay_location_code" => "The :attribute should contain first 2 letters(First Character Should be in Capital) of state code, 5 letters(First Character Should be in Capital) of station name, 3 letters(First Character Should be in Capital) of counter type,
                    first letter(Should be in Capital) of Bay Location Code, '-' after Bay Location Code, counter number at the end. (Ex: KaBangaPrsF-01).",
        "hyphen" => "The :attribute should contain first 2 letters(First Character Should be in Capital) of state code, 5 letters(First Character Should be in Capital) of station name, 3 letters(First Character Should be in Capital) of counter type,
                    first letter(Should be in Capital) of Bay Location Code, '-' after Bay Location Code, counter number at the end. (Ex: KaBangaPrsF-01).",
        "add_number" => "The :attribute should contain first 2 letters(First Character Should be in Capital) of state code, 5 letters(First Character Should be in Capital) of station name, 3 letters(First Character Should be in Capital) of counter type,
                    first letter(Should be in Capital) of Bay Location Code, '-' after Bay Location Code, counter number at the end. (Ex: KaBangaPrsF-01)."
        );

    public function __construct( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
        parent::__construct( $translator, $data, $rules, $messages, $customAttributes );

        $this->_set_custom_stuff();
    }

    /**
     * Setup any customizations etc
     *
     * @return void
     */
    protected function _set_custom_stuff() {
        //setup our custom error messages
        $this->setCustomMessages( $this->_custom_messages );
    }

    /**
     * Allow only first 2 characters of State Code, 1st letter should be Capital
     * @return bool
     */
    protected function validateStateCode( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Z][a-z]{0,2}/", $value );
    }

    /**
     * Allow only first 5 characters of Station Name, 1st letter should be Capital
    */
    protected function validateStationName( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Z][a-z]{0,2}[A-Z][a-z]{0,4}/", $value );
    }

    /**
     * Allow only first 3 characters of Counter type, 1st letter should be Capital
    */
    protected function validateCounterType( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Z][a-z]{0,2}[A-Z][a-z]{0,4}[A-Z][a-z]{0,2}/", $value );
    }

    /**
     * Allow only one character of BayLocation code, it should be Capital
    */
    protected function validateBayLocationCode( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Z][a-z]{0,2}[A-Z][a-z]{0,4}[A-Z][a-z]{0,2}[A-Z]{0,3}/", $value );
    }

    /**
     * Allow only hyphen.
    */
    protected function validateHyphen( $attribute, $value ) {
        return (bool) preg_match( "/^[A-Z][a-z]{0,2}[A-Z][a-z]{0,4}[A-Z][a-z]{0,2}[A-Z]{0,3}-/", $value );
    }

    /**
     * Add counter number at the end.
    */
    protected function validateAddNumber( $attribute, $value ) {
        return (bool) preg_match( "/(^[A-Z][a-z]{0,2}[A-Z][a-z]{0,4}[A-Z][a-z]{0,2}[A-Z]{0,3}-[0-9]*)/", $value );
    }

    protected function validateTimeFormat( $attribute, $value ) {
        return (bool) preg_match( "/^([01]?[0-9]|2[0-3]):([0-5][0-9])/", $value );
    }

}   //end of class

