<form class="form-horizontal" action="/admin/pictures/edit/<?= $picture['id'] ?>" method="POST">
    <fieldset>
        <legend>Промяна на картинката</legend>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="title">Име на картинката</label>
            <div class="col-sm-4 ">
                <input type="text" class="form-control" id="title" placeholder="Име" name="picture[name]"
                       value="<?= $picture['title'] ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="sel1">Категория:</label>
            <div class="col-sm-4 ">
                <select class="form-control " id="sel1" name="picture[category]" required>
                    <?= $categories ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-4">
                <a class="btn btn-default" href="/admin/pictures">Откажи</a>
                <button type="submit" class="btn btn-success">Запиши</button>
            </div>
        </div>
    </fieldset>

