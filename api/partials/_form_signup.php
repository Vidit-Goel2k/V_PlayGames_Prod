<div class="container">
    <h1>Please Signup for our website</h1>
    <form action="signup.php" method="post">
        <div class="mb-3">
            <label for="uname" class="form-label">User Name</label>
            <input type="text" maxlength="14" class="form-control" id="uname" name="uname" aria-describedby="emailHelp" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" maxlength="52" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="mb-3">
            <label for="pass" class="form-label">Password</label>
            <input type="password" maxlength="23" class="form-control" id="pass" name="pass" onkeyup='check();' required>
        </div>
        <div class="form-group">
            <label for="cpass">Confirm Password</label>
            <input type="password" maxlength="23" class="form-control" id="cpass" name="cpass" onkeyup='check();' required>
            <small id="emailHelp" class="form-text text-muted">Make sure to type the same password :</small>
            <span id='message' ></span>
        </div>
        <div class="mb-3">
            <label for="referral_code" class="form-label">Referral Code</label>
            <input type="text" maxlength="52" class="form-control" id="referral_code" name="referral_code" aria-describedby="emailHelp" >
            <small id="emailHelp" class="form-text text-muted">Enter a referral code to get 50 points!</small>
        </div>
        <button type="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- match passwords using javascript -->
<script>
    var check = function() {
        if (document.getElementById('pass').value !== document.getElementById('cpass').value) {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Passwords do not match';
            document.getElementById("submit").disabled = true;
        } else {
            document.getElementById('message').style.color = '#4CAF50';
            document.getElementById('message').innerHTML = 'Passwords match';
            document.getElementById("submit").disabled = false;
        }
    }
</script>