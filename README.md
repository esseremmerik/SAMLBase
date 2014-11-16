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

    TODO
        1. Support SOAP and Artifact binding
        2. Handle a Single Logout Request
        3. Refactor the template engine so that its not instantiating partials all the time
            3.1 Twig as an option?
                3.1.1 Disadvantage: Add a template engine that might not be used by the systems its used in
                3.1.2 Advantage: Easy templating and assigning of variables
            3.2 Automatic iterator to add partials via configuration in the template classes?
                3.2.1 Instead of adding all the partials with new instantiation, iterate over some setting information and automatically instantiate the right classes
                3.2.2 Classes might best be mapped as some form of service / helper, instead of calling them directly
                3.2.3 In this way you can remove them, mock them, change them around. But how?
            3.3 Main goal should be that now there is to much tight coupling between templates, it needs to go
        4. Give the library a better name, SAML2PHP is lame.
        5. Support persistency of the tokens
        6. Unit Tests
        7. Event listeners register
            7.1 dont want to write the whole listener system ourselves, what can we use thats predefined
            7.2 What does symfony use for listener service?
            7.3 How can we listen to events without having to add event listener code lines to the code?

## Examples (relative to package root)

    /index.php - Example AuthNRequest (Redirect and POST binding)
    /response.php - Example AuthNResponse target file (POST Binding)

## License information
    This code is released under the GPL v3 license
    Info about the license can be found here:  http://www.gnu.org/copyleft/gpl.html
