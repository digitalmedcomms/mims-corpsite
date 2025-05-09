/**
 * The code snippet for Debounce Strategy.
 *
 * @param {Function} callback     The callback function that will be debouce.
 * @param {Number}   waitingTime  The (N) milliseconds that the callback function  
 *                                will be call after no call action made.
 *
 * @return {Function}
 */
function debounce(callback, waitingTime) {

    if (typeof callback !== 'function') {
        throw Error('The first argument is not a type function.');
    }

    if (typeof waitingTime !== 'number') {
        throw Error('The second argument is not a type number');
    }

    var timeout = null;

    return function() {

        var context = this;
        var args = arguments;

        clearTimeout(timeout);

        timeout = setTimeout(function() {
            timeout = null;
            callback.apply(context, args);
        }, waitingTime);
    };
}

/**
 * The URL Ending Trailing Slash Helper.
 * 
 * 
 * This function helper handle some scenarios:
 *  1. If the given url have multiple ending trailing slash then this must
 *     cut and reduce to proper format.
 *  2. Check if the given url have ending trailing slash then this should be fine to use.
 *  3. If the given url do not have an ending trailing slash, at this scenario we do append
 *     a character in order to meet the requirement for the given url.
 * 
 * By default this function do the ff:
 *  1. Separate the query parameter from the URL and merge later on after passing some
 *     condition to determine if valid to add ending trailing slash.
 *  2. Seprate the anchor tag from the url or query parameter then later on will also be merge
 *     after some process are done. 
 * 
 * @param {String} url  The given url that will be analyze to determine if need to add
 *                      an ending trailing slash on it.
 * @return {String}
 */
function urlEndingTrailingSlash(url) {

    // Separate the url and query parameter.
    var separatedUrlAndQueryParameter = url.split('?');
    
    // Prepare the url only string.
    var urlOnly = separatedUrlAndQueryParameter[0];
  
    // Assume that the query parameter is not set.
    var queryParameterOnly = '';
    
    // If the separation is successful and the total length is greater 1
    // this means that we have a query parameter set on the given url.
    if (separatedUrlAndQueryParameter.length > 1) {
        queryParameterOnly = separatedUrlAndQueryParameter[1];  
    }
  
    // Assume that the anchor tag is not set.
    var anchorTag = '';
    
    // Check if the url is holding anchor tag.
    // Then we must separate it and put it on a proper variable.
    if (urlOnly.indexOf('#') > -1) {
        urlOnly = urlOnly.split('#');
        anchorTag = urlOnly[1];   
        urlOnly = urlOnly[0];
    }
    
    // Check if the query parameter is holding the anchor tag.
    // Then we must separate it and put it on a proper variable.
    if (queryParameterOnly.indexOf('#') > -1) {
        queryParameterOnly = queryParameterOnly.split('#');
        anchorTag = queryParameterOnly[1];   
        queryParameterOnly = queryParameterOnly[0];
    }

    // Filter if URL is less than or equal to 1 length and
    // only equal to "/" then we should return the inputed url.
    if (urlOnly.length <= 1 || urlOnly === '/') {
        return url;
    }

    // Generic function to handle condition to setting up the url with
    // query parameter.
    var appendQueryParameter = function () {
        return (queryParameterOnly ? '?' + queryParameterOnly : '');
    };

    // Generic function to handle condition to setting up the url with
    // query parameter.
    var appendAnchorTag = function() {
        return (anchorTag ? '#' + anchorTag : '');
    };

    // List of common file extensions that might be use in a URL.
    var commonFileExtensionList = function () {
        return [
            '.jpg',
            '.jpeg',
            '.png',
            '.gif'
        ];
    };

    // Verify if the URL is a file type.
    var isFileURLType = function () {

        var extensions = commonFileExtensionList();
        var extensionsLength = extensions.length - 1;

        for (var x = 0; x <= extensionsLength; x++) {
            // Check if the URL is a file type.
            if (urlOnly.indexOf(extensions[x]) > -1) {
                return true;
            }
        }

        return false;
    };
  
    // Set default max index for the given url characters.
    var maxIndex = (urlOnly.length - 1);
    
    // Smart to detect if the given url have multiple trailing slash.
    while (urlOnly[maxIndex] === '/') {
        
        var currentLastCharacter = urlOnly.substr(-1);
        
        // We need to check if the next character
        // is not a trailing slash.
        if (currentLastCharacter !== '/') {
            break;
        }
        
        // Remove the excess trailing slash.
        urlOnly = urlOnly.substr(0, maxIndex);
        // And reset the max index for the url.
        maxIndex = (urlOnly.length - 1);
    }
  
    if (isFileURLType()) {
        urlOnly = (urlOnly[maxIndex] === '/') ? urlOnly.substr(-1) : urlOnly;
        return urlOnly + appendQueryParameter() + appendAnchorTag();    
    }
    
    // If the GLOBAL_ENDING_TRAILING_SLASH constant is set to false then
    // we should remove or do not append an ending trailing slash.
    if (typeof GLOBAL_ENDING_TRAILING_SLASH !== 'undefined' && !GLOBAL_ENDING_TRAILING_SLASH) {
        
        if (urlOnly[maxIndex] === '/') {
            return urlOnly.substr(0, maxIndex) + appendQueryParameter() + appendAnchorTag();
        }
        
        return urlOnly + appendQueryParameter() + appendAnchorTag();
    }
    
    // Check if the last character is indeed ending trailing slash.
    // This means the url already in format with ending trailing slash.
    if (urlOnly[maxIndex] === '/') {
        return urlOnly + appendQueryParameter() + appendAnchorTag();
    }
    
    // If we reach this point then the given url does not have a
    // ending trailing slash.
    return urlOnly + '/' + appendQueryParameter() + appendAnchorTag();    
}

/**
 * The Minutes Based Time Format.
 * 
 * Ex. 1:01:00 = 61:00
 *     2:05:00 = 125:00
 * 
 * @param {Number} hour   The hour(s) of the given time.
 * @param {Number} minute The minute(s) of the given time.
 * @param {Number} second The second(s) of the given time.
 * 
 * @return {String} 
 */
function minutesBasedTimeFormat(hour, minute, second) {

    if (minute === 0 && second === 0) {
        return '00:00';
    }

    var minutesTotal = ('0' + minute).slice(-2);

    if (hour) {

        var hourInMinutes = hour * 60;

        minutesTotal = hourInMinutes + minute;
    }

    var secondsTOtal = ('0' + second).slice(-2);
    
    return minutesTotal + ':' + secondsTOtal;
}


function ajaxRequest(requestData, callbackFunc){

    $.ajax({
        url: requestData['url'],
        data : requestData['data'],
        type: requestData['type'],
        dataType: "json",

        success : function(response){

            if(typeof requestData['callback'] != 'undefined'){
                var callback = requestData['callback'];
                callback(requestData, response);
            }else{

                if(typeof callbackFunc != 'undefined'){
                    callbackFunc(requestData, response);
                }

            }
        },
        error : function(response){
            if(typeof requestData['errCallback'] != 'undefined'){
                var callback = requestData['errCallback'];
                callback(requestData, response);
            }
        }
    });

}


function strip_tags(string){
    return string.replace(/(<([^>]+)>)/gi, "");
}

var ScreenSizes = {
    isMobileSmaller: function () {
        return ($(window).width() <= 340);
    },
    isMobileCommon: function () {
        return ($(window).width() <= 992);
    },
    isTabletCommon: function () {
        return ($(window).width() >= 768 && $(window).width() <= 992);
    },
    isDesktopSmaller: function () {
        return ($(window).width() >= 993 && $(window).width() <= 1280);
    },
    isDesktop: function () {
        return ($(window).width() >= 1281);
    },
    isDesktopLarge: function () {
        return ($(window).width() >= 1366);
    }
};
