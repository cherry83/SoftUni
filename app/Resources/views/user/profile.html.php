    <form class="form-horizontal" action="/profile" method="post">
        <fieldset>
            <legend>Профил</legend>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_email">Email</label>
                <div class="col-sm-4 ">
                    <input class="form-control" id="user_email" placeholder="Email" name="user[email]" required type="email" value="<?=$user['email']?>" readonly>
                    <?=$email_error ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_fullName">Име</label>
                <div class="col-sm-4 ">
                    <input type="text" class="form-control" id="user_fullName" placeholder="Име" name="user[fullName]" required value="<?=$user['fullname']?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_password_first">Парола</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="user_password_old" placeholder="Парола" name="user[password][old]" required >
                     <?=$old_password_error ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_password_first">Нова парола</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="user_password_first" placeholder="Нова парола" name="user[password][first]">
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_password_second">Потвърди паролата</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="user_password_second" placeholder="Потвърди паролата" name="user[password][second]">
                    <?=$password_error ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-4 centered">
                    <a class="btn btn-default" href="/homepage">Отказ</a>
                    <button type="submit" class="btn btn-success">Запиши</button>
                </div>
            </div>

        </fieldset>
    </form>
