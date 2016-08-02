<?php

    namespace siosp\Libs\Helpers;

    class String {
        /**
         * Retona una cadena dada en camel separada con dashes "-" 
         * @param type $className
         * @return type
         * @author Fcodiaz <jfcodiaz@gmail.com>
         */
        public static function camel2dashed($className) {
            //http://ideone.com/wK42i
            return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
        }
        /**
         * Retona una cadena dada en camel separada con dashes "-" 
         * @param type $className
         * @return type
         * @author Fcodiaz <jfcodiaz@gmail.com>
         */
        public static function camel2ucwords($className) {
            //http://ideone.com/wK42i
            return ucwords(strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1 ', $className)));
        }
    }
    