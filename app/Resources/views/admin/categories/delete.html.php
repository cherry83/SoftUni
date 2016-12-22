            <form class="form-horizontal" action="/admin/categories/delete/<?=$category['id']?>" method="post">
                <fieldset>
                    <legend>Изтриване на категория</legend>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="category_title">Име на категорията</label>
                        <div class="col-sm-4 ">
                            <input type="text" class="form-control" id="category_title" placeholder="Име на категорията" name="category[name]" value="<?=$category['name']?>" readonly>
                            <?=$delete_error ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <a class="btn btn-default" href="/admin/categories">Откажи</a>
                            <button type="submit" class="btn btn-danger">Изтрий</button>
                        </div>
                    </div>
                </fieldset>
            </form>

