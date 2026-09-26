<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>About Us - Alzikrayat</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <div class="container">

        <a
            class="navbar-brand"
            href="/"
        >
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

                <li class="nav-item">

                    <a
                        class="nav-link"
                        href="/"
                    >
                        Home
                    </a>

                </li>

                <?php if (isset($_SESSION["user_id"])): ?>

                    <li class="nav-item">

                        <span class="nav-link">

                            Hi
                            <?= htmlspecialchars(
                                $_SESSION["first_name"]
                            ) ?>

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
            About Alzikrayat
        </h1>

        <p class="lead">
            A simple photo sharing application for preserving memories.
        </p>

    </div>

</header>


<section class="py-5">

    <div class="container">

        <div class="row g-4">

            <div class="col-md-6">

                <div class="card h-100 shadow-sm">

                    <div class="card-body">

                        <h2 class="card-title">
                            Our Application
                        </h2>

                        <p class="card-text">

                            Alzikrayat is a photo sharing application
                            designed to help users upload, organize,
                            view, and share memorable photos.

                        </p>

                        <p class="card-text">

                            Users can create an account, upload photos
                            with titles and descriptions, view photo
                            details, and interact through comments.

                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="card h-100 shadow-sm">

                    <div class="card-body">

                        <h2 class="card-title">
                            Our Goal
                        </h2>

                        <p class="card-text">

                            The goal of Alzikrayat is to provide a
                            simple and organized platform for preserving
                            personal memories through photographs.

                        </p>

                        <p class="card-text">

                            The application focuses on user accounts,
                            photo management, comments, authentication,
                            and secure database operations.

                        </p>

                    </div>

                </div>

            </div>

        </div>


        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <h2 class="card-title">
                    Technologies
                </h2>

                <ul>

                    <li>
                        PHP
                    </li>

                    <li>
                        MySQL / MariaDB
                    </li>

                    <li>
                        PDO
                    </li>

                    <li>
                        MVC Architecture
                    </li>

                    <li>
                        3-Tier Architecture
                    </li>

                    <li>
                        Bootstrap
                    </li>

                    <li>
                        HTML, CSS, and JavaScript
                    </li>

                </ul>

            </div>

        </div>


        <div class="text-center mt-5">

            <a
                href="/"
                class="btn btn-primary"
            >
                Back to Home
            </a>

        </div>

    </div>

</section>


<footer class="bg-dark text-white text-center py-3">

    <p class="mb-0">

        &copy;
        <?= date("Y") ?>
        Alzikrayat.
        All rights reserved.

    </p>

</footer>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

</body>

</html>
