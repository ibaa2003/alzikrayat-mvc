<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alzikrayat - Photo Sharing</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="/">
            Alzikrayat
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarContent"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="navbarContent"
        >

            <ul class="navbar-nav ms-auto">

                <?php if (isset($_SESSION["user_id"])): ?>

                    <li class="nav-item">
                        <span class="nav-link">
                            Hi <?= htmlspecialchars($_SESSION["first_name"]) ?>
                        </span>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="/logout"
                        >
                            Logout
                        </a>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="/login"
                        >
                            Please Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="/register"
                        >
                            Register
                        </a>
                    </li>

                <?php endif; ?>

            </ul>

        </div>

    </div>
</nav>


<header class="bg-light py-5">
    <div class="container text-center">

        <h1 class="display-5 fw-bold">
            Welcome to Alzikrayat
        </h1>

        <p class="lead">
            Share your memories through photos.
        </p>

        <?php if (isset($_SESSION["user_id"])): ?>

            <a
                href="/photo/upload"
                class="btn btn-primary"
            >
                Upload Photo
            </a>

        <?php else: ?>

            <a
                href="/register"
                class="btn btn-primary"
            >
                Join Alzikrayat
            </a>

        <?php endif; ?>

    </div>
</header>

<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-4">
            <h2>Alzikrayat Statistics</h2>
            <p class="text-muted">
                A quick overview of our photo sharing community.
            </p>
        </div>

        <div class="row g-4 text-center">

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="display-5 fw-bold">
                            <?= (int) $userCount ?>
                        </h2>

                        <p class="text-muted mb-0">
                            Registered Users
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="display-5 fw-bold">
                            <?= (int) $photoCount ?>
                        </h2>

                        <p class="text-muted mb-0">
                            Shared Photos
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h2 class="display-5 fw-bold">
                            <?= (int) $commentCount ?>
                        </h2>

                        <p class="text-muted mb-0">
                            Comments
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="py-5">

    <div class="container">

        <div class="row mb-4 align-items-center">

    <div class="col-md-6">
        <h2>
            Recent Photos
        </h2>
    </div>

    <div class="col-md-6 text-md-end mt-3 mt-md-0">

        <a
            href="/?layout=grid"
            class="btn <?= $layout === "grid" ? "btn-primary" : "btn-outline-primary" ?>"
        >
            Grid
        </a>

        <a
            href="/?layout=cards"
            class="btn <?= $layout === "cards" ? "btn-primary" : "btn-outline-primary" ?>"
        >
            Cards
        </a>
<a
    href="/?layout=carousel"
    class="btn <?= $layout === "carousel" ? "btn-primary" : "btn-outline-primary" ?>"
>
    Carousel
</a>

    </div>

</div>


      
                       

    </div>

</section>


<section class="bg-light py-5">

    <div class="container">

        <div class="row">

            <div class="col-md-4 mb-4">

                <h3>
                    Share
                </h3>

                <p>
                    Upload and share your favorite memories
                    with the Alzikrayat community.
                </p>

            </div>

            <div class="col-md-4 mb-4">

                <h3>
                    Discover
                </h3>

                <p>
                    Explore photos shared by other users
                    and discover new memories.
                </p>

            </div>

            <div class="col-md-4 mb-4">

                <h3>
                    About Us
                </h3>

                <p>
                    Alzikrayat is a photo sharing application
                    designed to organize and preserve memories.
                </p>

            </div>

        </div>
<?php
if ($layout === "cards") {
    require __DIR__ . "/layouts/cards.php";
} elseif ($layout === "carousel") {
    require __DIR__ . "/layouts/carousel.php";
} else {
    require __DIR__ . "/layouts/grid.php";
}
?>

    </div>

</section>


<footer class="bg-dark text-white text-center py-3">

    <p class="mb-0">
        &copy; <?= date("Y") ?> Alzikrayat.
        All rights reserved.
    </p>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>
</html>
