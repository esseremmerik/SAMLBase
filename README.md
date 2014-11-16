SAML2PHP
=======

##Introduction
Build SAML Connections in php object based.

##Status
Currently its possible to dynamically load the metadata, and after that, do a request via a POST or Redirect binding.
You can sign requests with a certificate. The response can be read, decrypted, verified and attributes can be retrieved.

##Setup
    composer install

Thats all!

## Current Status (Last updated 14-11-2014)

    There is more to do than what i've listed here, but this is to get the framework started

    DONE
        1. Resolve metadata from an IDP into a PHP array that we can work with
        2. Do a AuthNRequest via Redirect Binding
        3. Do a AuthNRequest via POST Binding
        4. Handle the AuthNResponse
        5. Pass thru returning attributes and claims
        6. Templates changed to twig
        7. Use a DIC to provide the classes with the necessary information

    TODO
        1. Support SOAP and Artifact binding
        2. Handle a Single Logout Request
        3. Give the library a better name, SAML2PHP is lame.
        4. Unit Tests
        5. Determine what we need caches for

## Examples (relative to package root)

    /example/index.php - Example AuthNRequest (Redirect and POST binding)
    /example/response.php - Example AuthNResponse target file (POST Binding)
    /example/attributes.php - WIP AttributeQuery request after being logged in (requires attributequery service on the IDP)
    /example/logout.php - WIP Logout request
    
## License information
    This code is released under the GPL v3 license
    Info about the license can be found here:  http://www.gnu.org/copyleft/gpl.html
