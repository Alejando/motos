!function () {
    'use strict';
    estrasol.utils.isMobile = function () {
        //fork http://stackoverflow.com/questions/21741841/detecting-ios-android-operating-system
        var userAgent = navigator.userAgent || navigator.vendor || window.opera;
           // Windows Phone must come first because its UA also contains "Android"
         if (/windows phone/i.test(userAgent)) {
             return true;
         }

         if (/android/i.test(userAgent)) {
             return true;
         }
         // iOS detection from: http://stackoverflow.com/a/9039885/177710
         if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
             return true;
         }
         return false;
    };
}();
