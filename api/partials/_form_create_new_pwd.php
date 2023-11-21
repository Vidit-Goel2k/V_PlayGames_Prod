<h5>Please enter your new password</h5> 
        <div class="container mt-2 p-2" class="row">
            <form class="form-inline" action="pwd_reset.php" method="post">
                <div class=" mb-3 col-5">
                    <input type="hidden" maxlength="52" class="form-control" name="selector" value="<?php echo $selector; ?>" aria-describedby="emailHelp" required>
                    <input type="hidden" maxlength="52" class="form-control" name="validator" value="<?php echo $validator; ?>" aria-describedby="emailHelp" required>

                    <div class="my-3">
                        <label for="pass" class="form-label p-1">Password</label>
                        <input type="password" placeholder="Enter New Password" maxlength="23" class="form-control" id="pass" name="pass" onkeyup='check();' required>
                    </div>
                    <div class="form-group ">
                        <label for="cpass" class="p-2">Confirm Password</label>
                        <input type="password" placeholder="Repeat New Password" maxlength="23" class="form-control mb-2" id="cpass" name="cpass" onkeyup='check();' required>
                        <small id="emailHelp" class="form-text text-muted">Make sure to type the same password <br></small>
                        <span id='message'></span>
                    </div>
                </div>
                <button type="submit" id="reset_pwd_submit" name="reset_pwd_submit" class="btn btn-primary">Reset Password</button>
            </form>
        </div>

        <!-- match passwords using javascript -->
        <script>
            var check = function() {
            if (document.getElementById('pass').value !== document.getElementById('cpass').value) {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Passwords do not match';
                document.getElementById("reset_pwd_submit").disabled = true;
            }else{
                document.getElementById('message').style.color = '#4CAF50';
                document.getElementById('message').innerHTML = 'Passwords match';
                document.getElementById("reset_pwd_submit").disabled = false;
            } 
        }
        </script>