 
            <h2>Потребители</h2>
            <div class="row">
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Име</th>
                        <th>Email</th>
                        <th>Действиве</th>
                    </tr>
                    </thead>
                    <tbody>
			<? foreach ($users as $user){ ?>
                        <tr>
                        <tr <? if($user['role']=='ROLE_ADMIN') { ?> class="info" <? } ?>>
                            <td><?=$user['id']?></td>
                            <td><?=$user['fullname']?></td>
                            <td><?=$user['email']?></td>
                            <td>
                                <a class="btn btn-info" href="/admin/users/edit/<?=$user['id']?>">Промяна</a>
                                <a class="btn btn-danger" href="/admin/users/delete/<?=$user['id']?>">Изтриване</a>
                            </td>
                        </tr>
                        <? } ?>
                    </tbody>
                </table>
            </div>



