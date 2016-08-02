<?php

    namespace siosp\Libs\Helpers;

    /**
     * Description of Numbers
     *
     * @author FcoDiaz
     */
    class Number {

        /**
         * Frok http://php.net/manual/en/function.base-convert.php#92960
         * 
         * @param type $integer
         * @param type $upcase
         * @return type
         * 
         */
        public static function int2Roman($integer, $upcase = true) {
            $table = [
              'M' => 1000,
              'CM' => 900,
              'D' => 500,
              'CD' => 400,
              'C' => 100,
              'XC' => 90,
              'L' => 50,
              'XL' => 40,
              'X' => 10,
              'IX' => 9,
              'V' => 5,
              'IV' => 4,
              'I' => 1];
            $return = '';
            while ($integer > 0) {
                foreach ($table as $rom => $arb) {
                    if ($integer >= $arb) {
                        $integer -= $arb;
                        $return .= $rom;
                        break;
                    }
                }
            }
            return $return;
        }

    }
    