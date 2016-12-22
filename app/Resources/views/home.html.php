    <div class="row text-center">
        <h2 style="color: #4b046b;">Последно добавени</h2>
    </div>

<div class="container-fluid">
    <div class="row">
        <? foreach ($last_pictures as $picture) { ?>
        <a href="/coloring/<?=$picture['id']?>">
        <div class="image-block col-sm-4" style="background: url(/outlines/<?=$picture['file']?>) no-repeat center top; background-size:100% 100%;">
            <p> <?=$picture['title']?> </p>
        </div>
        </a>
        <? } ?>
    </div>
</div>

 <div class="row text-center">
	<h2 style="color: #4b046b;">Най-предпочитани</h2>
</div>


<div class="container-fluid">
    <div class="row">
        <? foreach ($top_pictures as $picture) { ?>
        <a href="/coloring/<?=$picture['id']?>">
        <div class="image-block col-sm-4" style="background: url(/outlines/<?=$picture['file']?>) no-repeat center top; background-size:100% 100%;">
            <p> <?=$picture['title']?> </p>
        </div>
        </а>
        <? } ?>
    </div>
</div>
