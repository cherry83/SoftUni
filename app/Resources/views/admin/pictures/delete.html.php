<form class="form-horizontal" action="/admin/pictures/delete/<?= $picture['id'] ?>" method="post">
    <fieldset>
        <legend>Изтриване на картинка</legend>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="title">Име на картинката</label>
            <div class="col-sm-4 ">
                <input type="text" class="form-control" id="title" placeholder="Име " name="picture[name]"
                       value="<?= $picture['title'] ?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <img src="/outlines/<?= $picture['file'] ?>" class="col-sm-4 col-sm-offset-4"
                 style="border: 1px solid gray">
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-5">
                <a class="btn btn-default" href="/admin/pictures">Откажи</a>
                <button type="submit" class="btn btn-danger">Изтрий</button>
            </div>
        </div>
    </fieldset>
</form>

