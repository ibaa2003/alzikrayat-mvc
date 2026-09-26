<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Upload Photo - Alzikrayat</title>

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
            <span class="text-white me-3">
                Hi <?= htmlspecialchars($_SESSION["first_name"] ?? "User") ?>
            </span>

            <a href="/logout" class="btn btn-outline-light btn-sm">
                Logout
            </a>
        </div>

    </div>
</nav>


<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-body p-4">

                    <h2 class="mb-4 text-center">
                        Upload Photo
                    </h2>

                    <form
                        method="POST"
                        action="/photo/upload"
                        enctype="multipart/form-data"
                    ><input
    type="hidden"
    name="csrf_token"
    value="<?= htmlspecialchars($this->csrfToken()) ?>"
>                

                        <div class="mb-3">

                            <label class="form-label">
                                Photo
                            </label>

                            <input
                                type="file"
                                name="photo"
                                class="form-control"
                                accept="image/jpeg,image/png,image/gif,image/webp"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                class="form-control"
                                maxlength="200"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                            ></textarea>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Upload Photo
                        </button>

                    </form>


                    <div class="text-center mt-3">

                        <a href="/" class="text-decoration-none">
                            Back to Home
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
