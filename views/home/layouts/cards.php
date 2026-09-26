<?php if (!empty($photos)): ?>

    <div class="row g-4">

        <?php foreach ($photos as $photo): ?>

            <div class="col-md-6">

                <div class="card h-100 shadow">

                    <div class="row g-0 h-100">

                        <div class="col-md-5">

                            <img
                                src="/images/uploads/<?= htmlspecialchars($photo["file_name"]) ?>"
                                class="img-fluid rounded-start h-100 w-100"
                                alt="<?= htmlspecialchars($photo["title"]) ?>"
                                style="object-fit: cover; min-height: 250px;"
                            >

                        </div>

                        <div class="col-md-7">

                            <div class="card-body d-flex flex-column h-100">

                                <h4 class="card-title">
                                    <?= htmlspecialchars($photo["title"]) ?>
                                </h4>

                                <p class="card-text">
                                    <?= htmlspecialchars(
                                        $photo["description"] ?? ""
                                    ) ?>
                                </p>

                                <p class="text-muted mb-2">
                                    By
                                    <?= htmlspecialchars($photo["first_name"]) ?>
                                    <?= htmlspecialchars($photo["last_name"]) ?>
                                </p>

                                <p class="text-muted small">
                                    <?= htmlspecialchars($photo["date_time"]) ?>
                                </p>

                                <div class="mt-auto">

                                    <a
                                        href="/photo/<?= (int) $photo["id"] ?>"
                                        class="btn btn-primary"
                                    >
                                        View Photo
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

<?php else: ?>

    <div class="alert alert-info">
        No photos have been uploaded yet.
    </div>

<?php endif; ?>
