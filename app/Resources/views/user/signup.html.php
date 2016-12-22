    <form class="form-horizontal" action="/signup" method="post">
        <fieldset>
            <legend>Регистрация</legend>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_email">Email</label>
                <div class="col-sm-4 ">
                    <input class="form-control" id="user_email" placeholder="Email" name="user[email]" required type="email">
                    <?=$email_error ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_fullName">Име</label>
                <div class="col-sm-4 ">
                    <input type="text" class="form-control" id="user_fullName" placeholder="Име" name="user[fullName]" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_password_first">Парола</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="user_password_first" placeholder="Парола" name="user[password][first]" required>
                </div>
            </div>


            <div class="form-group">
                <label class="col-sm-4 control-label" for="user_password_second">Потвърди паролата</label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="user_password_second" placeholder="Потвърди паролата" name="user[password][second]" required>
                    <?=$password_error ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-4 centered">
                    <a class="btn btn-default" href="/homepage">Отказ</a>
                    <button type="submit" class="btn btn-success">Регистрирай</button>
                </div>
            </div>

        </fieldset>
    </form>
