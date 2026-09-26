<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Alzikrayat</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h1 class="h3 text-center mb-4">
                        Create Account
                    </h1>

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
                        action="/register"
                        novalidate
                    > <input
    type="hidden"
    name="csrf_token"
    value="<?= htmlspecialchars($this->csrfToken()) ?>"
>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($old["first_name"] ?? "") ?>"
                                    required
                                    maxlength="50"
                                >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($old["last_name"] ?? "") ?>"
                                    required
                                    maxlength="50"
                                >
                            </div>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?= htmlspecialchars($old["email"] ?? "") ?>"
                                required
                                maxlength="100"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                                minlength="8"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Location
                            </label>

                            <input
                                type="text"
                                name="location"
                                class="form-control"
                                value="<?= htmlspecialchars($old["location"] ?? "") ?>"
                                maxlength="100"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Occupation
                            </label>

                            <input
                                type="text"
                                name="occupation"
                                class="form-control"
                                value="<?= htmlspecialchars($old["occupation"] ?? "") ?>"
                                maxlength="100"
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="3"
                            ><?= htmlspecialchars($old["description"] ?? "") ?></textarea>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Register
                        </button>

                    </form>

                    <p class="text-center mt-3 mb-0">
                        Already have an account?
                        <a href="/login">Login</a>
                    </p>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>
