<?php

session_set_cookie_params([
    "lifetime" => 0,
    "path" => "/",
    "secure" => !empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off",
    "httponly" => true,
    "samesite" => "Lax"
]);

session_start();

require_once __DIR__ . "/../core/Router.php";
require_once __DIR__ . "/../routes/web.php";

$router->dispatch(
    $_SERVER["REQUEST_URI"],
    $_SERVER["REQUEST_METHOD"]
);
