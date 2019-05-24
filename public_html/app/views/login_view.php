<h1>Страница авторизации</h1>

<form action="" method="post" class="form-inline">
    <label class="sr-only" for="username">Имя:</label>
    <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
            <div class="input-group-text"><span class="glyphicon glyphicon-user"></span></div>
        </div>
        <input class="form-control" name="login" id="login" placeholder="Имя" type="text">
    </div>

    <label class="sr-only" for="userpass">Пароль:</label>
    <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
            <div class="input-group-text"><span class="glyphicon glyphicon-hand-right"></span></div>
        </div>
        <input class="form-control" name="password" id="password" placeholder="Пароль" type="password">
    </div>
    <button type="submit" class="btn btn-primary mb-2" name="btn">Войти</button>
</form>

<?php extract($data); ?>
<?php if($login_status == "access_granted") { ?>
<p style="color:green">Авторизация прошла успешно.</p>
<?php } elseif($login_status == "access_denied") { ?>
<p style="color:red">Логин и/или пароль введены неверно.</p>
<?php } ?>
