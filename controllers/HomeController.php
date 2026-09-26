<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/Photo.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/Comment.php";

class HomeController extends Controller
{
    private Photo $photoModel;
    private User $userModel;
    private Comment $commentModel;

    public function __construct()
    {
        $this->photoModel = new Photo();
        $this->userModel = new User();
        $this->commentModel = new Comment();
    }

    public function index(): void
{
    $photos = $this->photoModel->getAll();

    $layout = $_GET["layout"] ?? "grid";

    $allowedLayouts = [
    "grid",
    "cards",
    "carousel"
];

    if (!in_array($layout, $allowedLayouts, true)) {
        $layout = "grid";
    }

    $userCount = $this->userModel->count();
    $photoCount = $this->photoModel->count();
    $commentCount = $this->commentModel->count();

    $this->view("home/index", [
        "photos" => $photos,
        "userCount" => $userCount,
        "photoCount" => $photoCount,
        "commentCount" => $commentCount,
        "layout" => $layout
    ]);
}

    public function about(): void
    {
        $this->view("home/about");
    }
}
