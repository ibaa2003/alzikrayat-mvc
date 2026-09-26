<?php

require_once __DIR__ . "/../core/Controller.php";
require_once __DIR__ . "/../models/Photo.php";
require_once __DIR__ . "/../models/Comment.php";

class PhotoController extends Controller
{
    private Photo $photoModel;
    private Comment $commentModel;

    public function __construct()
    {
        $this->photoModel = new Photo();
        $this->commentModel = new Comment();
    }

    public function show(int $id): void
    {
        $photo = $this->photoModel->findById($id);

        if (!$photo) {
            http_response_code(404);
            echo "Photo not found.";
            return;
        }

        $comments = $this->commentModel->getByPhotoId($id);

        $this->view("photos/show", [
            "photo" => $photo,
            "comments" => $comments
        ]);
    }

    public function showUpload(): void
    {
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
if (!$this->verifyCsrfToken()) {
    http_response_code(403);
    echo "Invalid CSRF token.";
    return;
}
if (!$this->verifyCsrfToken()) {
    http_response_code(403);
    echo "Invalid CSRF token.";
    return;
}

        $this->view("photos/upload");
    }

    public function upload(): void
    {
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
if (!$this->verifyCsrfToken()) {
    http_response_code(403);
    echo "Invalid CSRF token.";
    return;
}

        $title = trim($_POST["title"] ?? "");
        $description = trim($_POST["description"] ?? "");

        $errors = [];

        if ($title === "") {
            $errors[] = "Photo title is required.";
        }

        if (strlen($title) > 200) {
            $errors[] = "Photo title must not exceed 200 characters.";
        }

        if (!isset($_FILES["photo"])) {
            $errors[] = "Please select an image.";
        } elseif ($_FILES["photo"]["error"] !== UPLOAD_ERR_OK) {
            $errors[] = "Image upload failed.";
        }

        if (!empty($errors)) {
            $this->view("photos/upload", [
                "errors" => $errors,
                "old" => [
                    "title" => $title,
                    "description" => $description
                ]
            ]);

            return;
        }

        $file = $_FILES["photo"];

        $maxSize = 5 * 1024 * 1024;

        if ($file["size"] > $maxSize) {
            $errors[] = "Image size must not exceed 5 MB.";
        }

        $allowedMimeTypes = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/gif" => "gif",
            "image/webp" => "webp"
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file["tmp_name"]);

        if (!isset($allowedMimeTypes[$mimeType])) {
            $errors[] = "Only JPEG, PNG, GIF, and WebP images are allowed.";
        }

        if (!empty($errors)) {
            $this->view("photos/upload", [
                "errors" => $errors,
                "old" => [
                    "title" => $title,
                    "description" => $description
                ]
            ]);

            return;
        }

        $extension = $allowedMimeTypes[$mimeType];

        $fileName = bin2hex(random_bytes(16)) . "." . $extension;

        $uploadDirectory = __DIR__ . "/../public/images/uploads/";

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        $destination = $uploadDirectory . $fileName;

        if (!move_uploaded_file($file["tmp_name"], $destination)) {
            $this->view("photos/upload", [
                "errors" => [
                    "Failed to save the uploaded image."
                ],
                "old" => [
                    "title" => $title,
                    "description" => $description
                ]
            ]);

            return;
        }

        try {
            $this->photoModel->create([
                "user_id" => (int) $_SESSION["user_id"],
                "file_name" => $fileName,
                "title" => $title,
                "description" => $description
            ]);
        } catch (Throwable $e) {
            if (file_exists($destination)) {
                unlink($destination);
            }

            $this->view("photos/upload", [
                "errors" => [
                    "Failed to save photo information."
                ],
                "old" => [
                    "title" => $title,
                    "description" => $description
                ]
            ]);

            return;
        }

        $this->redirect("/");
    }

    public function addComment(int $photoId): void
    {
        if (!isset($_SESSION["user_id"])) {
            $this->redirect("/login");
        }
if (!$this->verifyCsrfToken()) {
    http_response_code(403);
    echo "Invalid CSRF token.";
    return;
}

        $comment = trim($_POST["comment"] ?? "");

        if ($comment === "") {
            $this->redirect("/photo/" . $photoId);
        }

        if (strlen($comment) > 1000) {
            $comment = substr($comment, 0, 1000);
        }

        $photo = $this->photoModel->findById($photoId);

        if (!$photo) {
            http_response_code(404);
            echo "Photo not found.";
            return;
        }

        $this->commentModel->create([
            "photo_id" => $photoId,
            "user_id" => (int) $_SESSION["user_id"],
            "comment" => $comment
        ]);

        $this->redirect("/photo/" . $photoId);
    }
public function deleteComment(int $photoId, int $commentId): void
{
    if (!isset($_SESSION["user_id"])) {
        $this->redirect("/login");
    }

    $this->commentModel->delete(
        $commentId,
        (int) $_SESSION["user_id"]
    );

    $this->redirect("/photo/" . $photoId);
}

public function delete(int $id): void
{
    if (!isset($_SESSION["user_id"])) {
        $this->redirect("/login");
    }

    $userId = (int) $_SESSION["user_id"];

    $this->photoModel->delete($id, $userId);

    $this->redirect("/");
}
}
