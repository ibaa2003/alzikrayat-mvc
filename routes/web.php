<?php

require_once __DIR__ . "/../core/Router.php";
require_once __DIR__ . "/../controllers/AuthController.php";
require_once __DIR__ . "/../controllers/HomeController.php";
require_once __DIR__ . "/../controllers/PhotoController.php";

$router = new Router();

$authController = new AuthController();
$homeController = new HomeController();
$photoController = new PhotoController();
$router->get(
    "#^/$#",
    [$homeController, "index"]
);
$router->get(
    "#^/about$#",
    [$homeController, "about"]
);

$router->get(
    "#^/login$#",
    [$authController, "showLogin"]
);

$router->post(
    "#^/login$#",
    [$authController, "login"]
);

$router->get(
    "#^/register$#",
    [$authController, "showRegister"]
);

$router->post(
    "#^/register$#",
    [$authController, "register"]
);

$router->get(
    "#^/logout$#",
    [$authController, "logout"]
);

$router->get(
    "#^/photo/upload$#",
    [$photoController, "showUpload"]
);

$router->post(
    "#^/photo/upload$#",
    [$photoController, "upload"]
);

$router->post(
    "#^/photo/([0-9]+)/comment$#",
    [$photoController, "addComment"]
);

$router->post(
    "#^/photo/([0-9]+)/delete$#",
    [$photoController, "delete"]
);

$router->post(
    "#^/photo/([0-9]+)/comment/([0-9]+)/delete$#",
    [$photoController, "deleteComment"]
);

$router->get(
    "#^/photo/([0-9]+)$#",
    [$photoController, "show"]
);
