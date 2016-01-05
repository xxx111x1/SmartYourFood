$(document).ready(function() {
    var screenWidth = effectiveDeviceWidth;
    var height = effectiveDeviceHeight;
    $('html').width(screenWidth);
    $('html').height(height);
    $('body').width(screenWidth);
    
    function effectiveDeviceWidth() {
        var deviceWidth = window.orientation == 0 ? window.screen.width : window.screen.height;
        // iOS returns available pixels, Android returns pixels / pixel ratio
        // http://www.quirksmode.org/blog/archives/2012/07/more_about_devi.html
        if (navigator.userAgent.indexOf('Android') >= 0 && window.devicePixelRatio) {
            deviceWidth = deviceWidth / window.devicePixelRatio;        }
        return deviceWidth;
    }
    
    function effectiveDeviceHeight() {
        var deviceHeight = window.orientation == 0 ? window.screen.Height : window.screen.width;
        // iOS returns available pixels, Android returns pixels / pixel ratio
        // http://www.quirksmode.org/blog/archives/2012/07/more_about_devi.html
        if (navigator.userAgent.indexOf('Android') >= 0 && window.devicePixelRatio) {
        	deviceHeight = deviceHeight / window.devicePixelRatio;
        }
        return deviceHeight;
    }

});