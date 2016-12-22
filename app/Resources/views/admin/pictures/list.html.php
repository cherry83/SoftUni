            <h2>Картинки -
                <a href="/admin/pictures/upload" class="btn btn-warning">Добави нова</a>
            </h2>
            <div class="row">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Преглед</th>
                        <th>Име</th>
                        <th>Категория</th>
                        <th>Добавена</th>
                        <th>Прегледи</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    <? foreach ($pictures as $picture){ ?>

                        <tr>
                        <tr>
                            <td><?=$picture['id'] ?></td>
                            <td><img src="/outlines/<?=$picture['file'] ?>" width=100></td>
                            <td><?=$picture['title'] ?></td>
                            <td><?=$picture['category'] ?></td>
                            <td><?=date('d.m.Y H:i:s', $picture['date']) ?></td>
                            <td><?=$picture['views'] ?></td>
                            <td>
                                <a class="btn btn-info" href="/admin/pictures/edit/<?=$picture['id']?>">Промени</a>
                                <a class="btn btn-danger" href="/admin/pictures/delete/<?=$picture['id']?>">Изтрий</a>
                            </td>
                        </tr>
                    <? } ?>
                    </tbody>
                </table>
            </div>

