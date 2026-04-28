<?php
/**
 * 独自バリデーションを追加
 */
class Validation_Japanese
{
    /**
     *
     */
    public static function _validation_hiragana($val)
    {
        if( empty($val) ){ return true; }

        mb_regex_encoding("UTF-8");
        if (preg_match("/^[ 　ぁ-んー]+$/u", $val)) {
            return true;
        }
        return false;
    }

    /**
     *
     */
    public static function _validation_katakana($val)
    {
        mb_regex_encoding("UTF-8");
        if (preg_match("/^[ 　ァ-ヶー]+$/u", $val)) {
            return true;
        }
        return false;
    }

    /**
     *
     */
    public static function _validation_hirakata($val)
    {
        if( empty($val) ){ return true; }

        mb_regex_encoding("UTF-8");
        if (preg_match("/^[ 　ぁ-んァ-ヶー]+$/u", $val)) {
            return true;
        }

        return false;
    }
}