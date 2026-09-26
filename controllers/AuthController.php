<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/User.php";

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showRegister(): void
    {
        $this->view("auth/register");
    }

    public function register(): void
    {
if (!$this->verifyCsrfToken()) {
    http_response_code(403);
    echo "Invalid CSRF token.";
    return;
}
        $data = [
            "first_name" => trim($_POST["first_name"] ?? ""),
            "last_name" => trim($_POST["last_name"] ?? ""),
            "email" => trim($_POST["email"] ?? ""),
            "password" => $_POST["password"] ?? "",
            "location" => trim($_POST["location"] ?? ""),
            "description" => trim($_POST["description"] ?? ""),
            "occupation" => trim($_POST["occupation"] ?? "")
        ];

        $errors = [];

        if ($data["first_name"] === "") {
            $errors[] = "First name is required.";
        }

        if ($data["last_name"] === "") {
            $errors[] = "Last name is required.";
        }

        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid email is required.";
        }

        if (strlen($data["password"]) < 8) {
            $errors[] = "Password must be at least 8 characters.";
        }

        if ($this->userModel->emailExists($data["email"])) {
            $errors[] = "Email address is already registered.";
        }

        if (!empty($errors)) {
            $this->view("auth/register", [
                "errors" => $errors,
                "old" => $data
            ]);

            return;
        }

        $data["password"] = password_hash(
            $data["password"],
            PASSWORD_BCRYPT
        );

        $this->userModel->create($data);

        $this->redirect("/login");
    }

    public function showLogin(): void
    {
        $lastLogin = $_COOKIE["last_login"] ?? null;

        $this->view("auth/login", [
            "lastLogin" => $lastLogin
        ]);
    }

    public function login(): void
    { if (!$this->verifyCsrfToken()) {
    http_response_code(403);
    echo "Invalid CSRF token.";
    return;
}
        $email = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";

        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid email is required.";
        }

        if ($password === "") {
            $errors[] = "Password is required.";
        }

        if (!empty($errors)) {
            $this->view("auth/login", [
                "errors" => $errors,
                "old" => [
                    "email" => $email
                ]
            ]);

            return;
        }

        $user = $this->userModel->findByEmail($email);

        if (
            !$user ||
            !password_verify($password, $user["password"])
        ) {
            $this->view("auth/login", [
                "errors" => [
                    "Invalid email or password."
                ],
                "old" => [
                    "email" => $email
                ]
            ]);

            return;
        }

        session_regenerate_id(true);

        $_SESSION["user_id"] = (int) $user["id"];
        $_SESSION["first_name"] = $user["first_name"];
        $_SESSION["last_name"] = $user["last_name"];
        $_SESSION["email"] = $user["email"];

        
        setcookie(
    "last_login",
    date("Y-m-d H:i:s"),
    [
        "expires" => time() + (7 * 24 * 60 * 60),
        "path" => "/",
        "secure" => !empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off",
        "httponly" => true,
        "samesite" => "Lax"
    ]
);

        $this->redirect("/");
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        $this->redirect("/login");
    }
}
