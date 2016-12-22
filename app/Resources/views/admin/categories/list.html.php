            <h2>Категории -
                <a href="/admin/categories/create" class="btn btn-warning">Създай нова</a>
            </h2>
            <div class="row">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Име</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($categories as $category){ ?>

                        <tr>
                        <tr>
                            <td><?=$category['id'] ?></td>
                            <td><?=$category['name'] ?></td>
                            <td>
                                <a class="btn btn-info" href="/admin/categories/edit/<?=$category['id']?>">Промени</a>
                                <a class="btn btn-danger" href="/admin/categories/delete/<?=$category['id']?>">Изтрий</a>
                            </td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
            </div>

