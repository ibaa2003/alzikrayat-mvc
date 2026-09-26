<?php if (!empty($photos)): ?>

    <div id="photoCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-indicators">

            <?php foreach ($photos as $index => $photo): ?>

                <button
                    type="button"
                    data-bs-target="#photoCarousel"
                    data-bs-slide-to="<?= $index ?>"
                    class="<?= $index === 0 ? "active" : "" ?>"
                    aria-current="<?= $index === 0 ? "true" : "false" ?>"
                    aria-label="Slide <?= $index + 1 ?>"
                ></button>

            <?php endforeach; ?>

        </div>

        <div class="carousel-inner">

            <?php foreach ($photos as $index => $photo): ?>

                <div class="carousel-item <?= $index === 0 ? "active" : "" ?>">

                    <img
                        src="/images/uploads/<?= htmlspecialchars($photo["file_name"]) ?>"
                        class="d-block w-100"
                        alt="<?= htmlspecialchars($photo["title"]) ?>"
                        style="height: 500px; object-fit: cover;"
                    >

                    <div class="carousel-caption d-none d-md-block">

                        <h5>
                            <?= htmlspecialchars($photo["title"]) ?>
                        </h5>

                        <p>
                            <?= htmlspecialchars(
                                $photo["description"] ?? ""
                            ) ?>
                        </p>

                        <a
                            href="/photo/<?= (int) $photo["id"] ?>"
                            class="btn btn-primary"
                        >
                            View Photo
                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#photoCarousel"
            data-bs-slide="prev"
        >
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>

        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#photoCarousel"
            data-bs-slide="next"
        >
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>

<?php else: ?>

    <div class="alert alert-info">
        No photos have been uploaded yet.
    </div>

<?php endif; ?>
