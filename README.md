# PHP 7.4 Simple HTTP Client

A simple HTTP Client package written on vanilla PHP 7.4.

Built-in functionality for defining default headers `Content-Type` and `Accept` with `application/json` 
if user not define them in order to support send/retrieve JSON payloads.

Built-in functionality to automatically converts HTTP query string into JSON payload if the method is
`POST/PUT/PATCH` and vice versa.

**Predefined methods**
* GET
* HEAD
* POST
* PUT
* PATCH
* DELETE
* OPTIONS