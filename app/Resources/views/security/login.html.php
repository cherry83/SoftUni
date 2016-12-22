<form class="form-horizontal" name="authenticate" action="/login" method="post">
    <fieldset>
        <legend>Вписване</legend>

        <input type="hidden" name="_csrf_token" value="">

        <div class="form-group">
            <label class="col-sm-4 control-label">Имейл</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="_username" placeholder="Имейл">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label">Парола</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name="_password" placeholder="Парола">
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-4 centered">
                <?= $login_error ?>
                <a class="btn btn-default" href="/homepage">Отказ</a>

                <button type="submit" class="btn btn-primary">Впиши се</button>
            </div>
        </div>
    </fieldset>
    

   

