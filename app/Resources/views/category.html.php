<div class="container-fluid">
    <div class="row">
        <? foreach ($pictures as $picture) { ?>
            <a href="/coloring/<?= $picture['id'] ?>">
                <div class="image-block col-sm-4"
                     style="background: url(/outlines/<?= $picture['file'] ?>) no-repeat center top; background-size:100% 100%;">
                    <p> <?= $picture['title'] ?> </p>
                </div>
            </a>
        <? } ?>
    </div>
</div>