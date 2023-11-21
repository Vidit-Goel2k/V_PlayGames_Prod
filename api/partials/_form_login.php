<title>Login Form</title>

<div class="container">
    <h1>Please Login to our website</h1>
    <form action="login.php" method="post">
        <div class="mb-3">
            <label for="uname" class="form-label">User Name</label>
            <input type="text" maxlength="14" class="form-control" id="uname" name="uname" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Password</label>
            <input type="password" maxlength="23" class="form-control" id="pass" name="pass" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary" href="login_sys\forgot_pass.php" role="button">Forgot Password</a>
    </form>
</div>