<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($photo["title"]) ?> - Alzikrayat
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="/">
            Alzikrayat
        </a>

        <div>

            <?php if (isset($_SESSION["user_id"])): ?>

                <span class="text-white me-3">
                    Hi <?= htmlspecialchars($_SESSION["first_name"]) ?>
                </span>

                <a
                    href="/logout"
                    class="btn btn-outline-light btn-sm"
                >
                    Logout
                </a>

            <?php else: ?>

                <a
                    href="/login"
                    class="btn btn-outline-light btn-sm"
                >
                    Login
                </a>

            <?php endif; ?>

        </div>

    </div>

</nav>


<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card shadow">

                <div class="card-body">

                    <h1 class="mb-3">
                        <?= htmlspecialchars($photo["title"]) ?>
                    </h1>


                    <div class="text-muted mb-3">

                        By
                        <strong>
                            <?= htmlspecialchars(
                                $photo["first_name"] . " " . $photo["last_name"]
                            ) ?>
                        </strong>

                        |
                        
                        <?= htmlspecialchars($photo["date_time"]) ?>

                    </div>


                    <div class="text-center mb-4">

                        <img
                            src="/images/uploads/<?= htmlspecialchars($photo["file_name"]) ?>"
                            alt="<?= htmlspecialchars($photo["title"]) ?>"
                            class="img-fluid rounded shadow"
                        >

                    </div>


                    <?php if (!empty($photo["description"])): ?>

                        <div class="mb-4">

                            <h4>
                                Description
                            </h4>

                            <p class="text-muted">
                                <?= nl2br(
                                    htmlspecialchars($photo["description"])
                                ) ?>
                            </p>

                        </div>

                    <?php endif; ?>
<hr class="my-5">

<h3 class="mb-4">
    Comments
</h3>

<?php if (!empty($comments)): ?>

    <?php foreach ($comments as $comment): ?>

        <div class="card mb-3">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <strong>
                        <?= htmlspecialchars(
                            $comment["first_name"] . " " . $comment["last_name"]
                        ) ?>
                    </strong>

                    <small class="text-muted">
                        <?= htmlspecialchars($comment["date_time"]) ?>
                    </small>

                </div>

                <p class="mb-0 mt-2">
                    <?= nl2br(
                        htmlspecialchars($comment["comment"])
                    ) ?>
                </p>
<?php if (
    isset($_SESSION["user_id"]) &&
    (int) $_SESSION["user_id"] === (int) $comment["user_id"]
): ?>

    <form
        method="POST"
        action="/photo/<?= (int) $photo["id"] ?>/comment/<?= (int) $comment["id"] ?>/delete"
        class="mt-2"
    >
<input
    type="hidden"
    name="csrf_token"
    value="<?= htmlspecialchars($this->csrfToken()) ?>"
>

        <button
            type="submit"
            class="btn btn-sm btn-outline-danger"
            onclick="return confirm('Are you sure you want to delete this comment?');"
        >
            Delete
        </button>

<input
    type="hidden"
    name="csrf_token"
    value="<?= htmlspecialchars($this->csrfToken()) ?>"
>
    </form>

<?php endif; ?>

            </div>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p class="text-muted">
        No comments yet.
    </p>

<?php endif; ?>


                    <div class="text-center">
<?php if (isset($_SESSION["user_id"])): ?>

    <hr class="my-5">

    <h4 class="mb-3">
        Add a Comment
    </h4>

    <form
        method="POST"
        action="/photo/<?= (int) $photo["id"] ?>/comment"
    > <input
    type="hidden"
    name="csrf_token"
    value="<?= htmlspecialchars($this->csrfToken()) ?>"
>

        <div class="mb-3">

            <textarea
                name="comment"
                class="form-control"
                rows="4"
                maxlength="1000"
                placeholder="Write your comment..."
                required
            ></textarea>

        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Add Comment
        </button>

    </form>

<?php else: ?>

    <p class="text-muted">
        Please <a href="/login">login</a> to add a comment.
    </p>

<?php endif; ?>

                    <div class="text-center">

    <?php if (
        isset($_SESSION["user_id"]) &&
        (int) $_SESSION["user_id"] === (int) $photo["user_id"]
    ): ?>

        <form
            method="POST"
            action="/photo/<?= (int) $photo["id"] ?>/delete"
            class="d-inline"
        >

            <button
                type="submit"
                class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this photo?');"
            >
                Delete Photo
            </button>

        </form>

    <?php endif; ?>

    <a
        href="/"
        class="btn btn-secondary"
    >
        Back to Home
    </a>

</div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
