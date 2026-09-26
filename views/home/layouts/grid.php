<?php if (!empty($photos)): ?>

    <div class="row g-4">

        <?php foreach ($photos as $photo): ?>

            <div class="col-sm-6 col-md-4 col-lg-3">

                <div class="card h-100 shadow-sm">

                    <img
                        src="/images/uploads/<?= htmlspecialchars($photo["file_name"]) ?>"
                        class="card-img-top"
                        alt="<?= htmlspecialchars($photo["title"]) ?>"
                        style="height: 220px; object-fit: cover;"
                    >

                    <div class="card-body">

                        <h5 class="card-title">
                            <?= htmlspecialchars($photo["title"]) ?>
                        </h5>

                        <p class="card-text">
                            <?= htmlspecialchars(
                                $photo["description"] ?? ""
                            ) ?>
                        </p>

                        <small class="text-muted">
                            By
                            <?= htmlspecialchars($photo["first_name"]) ?>
                            <?= htmlspecialchars($photo["last_name"]) ?>
                        </small>

                    </div>

                    <div class="card-footer bg-white">

                        <a
                            href="/photo/<?= (int) $photo["id"] ?>"
                            class="btn btn-outline-primary btn-sm"
                        >
                            View Photo
                        </a>

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
