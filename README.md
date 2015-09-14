Googl function
===========
A PHP function for interacting with Goo.gl shortening service.

License
-------
Released under the MIT license:
http://kukawski.pl/mit-license.txt

Details
-------

This is second version of the library. Previously the library defined a class, but an object oriented approach, especially error handling using exceptions is not very "native"-PHP, at least not yet, so a decision was made to turn the library into a single function, which returns false on failure.

The first version of the library is available under v1 branch: https://github.com/kukawski/googl-php/tree/v1

Sample code
-----------
    define('GOOGL_API_KEY', 'YOUR KEY'); // if want to use API key, define as constant
    
    $shortcut = googl('https://github.com/kukawski/googl-php'); // https://goo.gl/XykKB
    
    if ($shortcut !== null) {
        $long = googl('https://goo.gl/XykKB', 'expand');
    }

    