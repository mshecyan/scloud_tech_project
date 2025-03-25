<div class="container-fluid">
    <div class="container d-flex justify-content-center" style="max-width: 450px;">
        <form action="/api/api.php?method=login" method="post"class="d-flex flex-column w-100 loginForm">
            <h5 class="h5 mb-3 fw-normal text-center mb-4">Авторизация</h5>

            <div class="form-floating">
                <input type="text" class="form-control rounded-0 rounded-top" id="loginInput" name="login" placeholder="Логин" required minlength="4">
                <label for="loginInput">Имя пользователя</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control rounded-0 border-top-0 rounded-bottom" id="passwordInput" name="password" placeholder="Пароль" required minlength="4">
                <label for="passwordInput">Пароль</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary mt-4 fs-6" type="submit">Войти</button>
        </form>
    </div>
</div>

