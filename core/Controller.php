<?php

class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

        $viewPath = __DIR__ . "/../views/" . $view . ".php";

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View not found: " . $view);
        }
    }

    protected function redirect(string $url): void
    {
        header("Location: " . $url);
        exit;
    }

    protected function csrfToken(): string
    {
        if (empty($_SESSION["csrf_token"])) {
            $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
        }

        return $_SESSION["csrf_token"];
    }

    protected function verifyCsrfToken(): bool
    {
        $token = $_POST["csrf_token"] ?? "";

        return isset($_SESSION["csrf_token"])
            && is_string($token)
            && hash_equals($_SESSION["csrf_token"], $token);
    }
}
