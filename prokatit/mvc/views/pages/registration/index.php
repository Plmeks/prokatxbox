<div class="col-lg-8 col-lg-offset-2">
    <div class="page-header">
        <h2>Регистрация нового пользователя</h2>
    </div>

    <form id="registerForm" method="post" class="form-horizontal" action="">
        <div class="form-group">
            <label class="col-lg-3 control-label">Имя пользователя</label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="login" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Email адрес</label>
            <div class="col-lg-5">
                <input type="text" class="form-control" name="email" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Пароль</label>
            <div class="col-lg-5">
                <input type="password" class="form-control" name="password" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Подтвердите пароль</label>
            <div class="col-lg-5">
                <input type="password" class="form-control" name="confirmPassword" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                <button type="submit" class="btn btn-primary">Зарегестрировать</button>
            </div>
        </div>
    </form>
</div>