
            <form class="form-horizontal" action="/admin/categories/edit/<?=$category['id']?>" method="POST">
                <fieldset>
                    <legend>Промяна на категория</legend>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="article_title">Име на категорията</label>
                        <div class="col-sm-4 ">
                            <input type="text" class="form-control" id="article_title" placeholder="Име" name="category[name]" value="<?=$category['name']?>" required>
	                        <?=$category_error?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-4">
                            <a class="btn btn-default" href="/admin/categories">Откажи</a>
                            <button type="submit" class="btn btn-success">Запиши</button>
                        </div>
                    </div>
                </fieldset>

