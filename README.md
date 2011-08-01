Googl class
===========
A PHP class for interacting with Goo.gl shortening service.

License
-------
Released under the MIT license:
http://kukawski.pl/mit-license.txt

Sample code
-----------
    $apiKey = "your-api-key";
    $googl = new Googl($apiKey); // API key is optional

    try {
        $shortcut = $googl->createShortcut('https://github.com/rafaelk/googl-php'); // http://goo.gl/UIEg1
    } catch (Exception $e) {
        var_dump($e);
    }

    try {
        $details = $googl->expandShortcut('http://goo.gl/UIEg1', Googl::ANALYTICS_FULL);
    } catch (Exception $e) {
        var_dump($e);
    }