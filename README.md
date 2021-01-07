Googl function
===========
A PHP function for interacting with Goo.gl shortening service.

License
-------
Released under the MIT license:
http://kukawski.pl/mit-license.txt

Details
-------

This is second version of the library. Previously, the library used an object-oriented design, but it wasn't very user/developer friendly. A single function approach is much simpler to use and follows design principles of many PHP standard library features.

The first version of the library is available on v1 branch: https://github.com/kukawski/googl-php/tree/v1

The project is now archived, because Goo.gl reached its end of life.

Sample code
-----------
    define('GOOGL_API_KEY', 'YOUR KEY'); // if want to use API key, define as constant
    
    $shortcut = googl('https://github.com/kukawski/googl-php'); // https://goo.gl/XykKB
    
    if (!$shortcut) {
        $long = googl('https://goo.gl/XykKB', 'expand');
    }

    
