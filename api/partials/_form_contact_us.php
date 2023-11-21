<h5>Write us a message</h5>
<div class="container mt-2 p-2" class="row">
    <form class="form-inline" action="" method="post">
        <div class=" mb-3 col-5">
            <div class="my-3">
                <label for="exampleFormControlInput1" class="form-label">UserName</label>
                <input class="form-control" name="uname" type="text" value="<?php echo $_SESSION["uname"] ?>" aria-label="readonly input example" readonly>
            </div>
            <div class="form-group ">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input class="form-control" name="email" type="email" value="<?php echo $_SESSION["email"] ?>" aria-label="readonly input example" readonly>
            </div>

            <div class="form-group my-3 ">
                <label for="exampleFormControlTextarea1" class="form-label">Subject</label>
                <textarea class="form-control" name="subject" placeholder="What are you writing us about" id="exampleFormControlTextarea1" rows="1"></textarea>
            </div>

            <div class="form-group my-3 ">
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea class="form-control" name="message" placeholder="We'd love to hear from you! Whether you have a question about the site, a product roundup or want to pitch us you can reach out to us by simply typing your message here" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

        </div>
        <button type="submit" id="contact_us_submit" name="contact_us_submit" class="btn btn-primary">Send us your message</button>
    </form>
</div>