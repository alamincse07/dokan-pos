<?php
/**
 * Created by PhpStorm.
 * User: Sabbir
 * Date: 5/14/14
 * Time: 11:19 AM
 */

class Language {

    static $language;

    function __construct($language="en"){
        return self::$language = $language;
    }

    function g($key){
        $language = self::$language;
        $languageData = $this->lPack();

        $languageDataSet = @$languageData[$language];

        return (isset($languageDataSet[$key])) ?  $languageDataSet[$key]: $key;

    }


    function humanReadAbleLanguage(){
        return array(
            'en'=>'English',
            'ar'=>'Arabic',
            'bn'=>'Bengali',
            'phl'=>'Filipino',
            'fr'=>'French',
            'gr'=>'German',
            'hi'=>'Hindi',
            'ja'=>'Japanese',
            'ko'=>'Korean',
            'ms'=>'Malaysian - Malay',
            'md'=>'Mandarin',
            'nt'=>'Not Specified',
            'pt'=>'Portuguese',
            'ru'=>'Russian',
            'es'=>'Spanish',
            'sv'=>'Swedish',
            'uk'=>'Ukrainian',
        );
    }

    function getHumanReadAbleLanguageByCode($code){
        $language = $this->humanReadAbleLanguage();
        if(isset($language[$code])){
            return $language[$code];
        }else{
            return $language["en"];
        }
    }

    function lPack(){
        return
            array(

                //english
                'en'=>LEn::get(),
                //Dutch
                'nl'=>LNl::get()
            );


    }

}