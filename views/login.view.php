<form class="w-50 mx-auto" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?= $data['username'] ?? ''?>" class="form-control" id="username" aria-describedby="usernameHelp">
        <small class="text-danger"><?= $data['usernameError'] ?? '' ?></small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password">
        <small class="text-danger"><?= $data['passwordError'] ?? '' ?></small>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" name="remember" id="remember">
        <label class="form-check-label" for="remember">Remember Me</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>