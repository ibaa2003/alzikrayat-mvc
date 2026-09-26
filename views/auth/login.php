<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Alzikrayat</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h3 text-center mb-4">
                        Login
                    </h1>

                    <?php if (!empty($lastLogin)): ?>

                        <div class="alert alert-info">
                            Last successful login:
                            <strong>
                                <?= htmlspecialchars($lastLogin) ?>
                            </strong>
                        </div>

                    <?php endif; ?>

                    <?php if (!empty($errors)): ?>

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                <?php foreach ($errors as $error): ?>

                                    <li>
                                        <?= htmlspecialchars($error) ?>
                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        </div>

                    <?php endif; ?>

                    <form
                        method="POST"
                        action="/login"
                    >  <input
    type="hidden"
    name="csrf_token"
    value="<?= htmlspecialchars($this->csrfToken()) ?>"
>

                        <div class="mb-3">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                value="<?= htmlspecialchars($old["email"] ?? "") ?>"
                                required
                                maxlength="100"
                            >

                        </div>

                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>

                    <p class="text-center mt-3 mb-0">

                        Don't have an account?

                        <a href="/register">
                            Register
                        </a>

                    </p>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
