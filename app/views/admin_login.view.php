<?php
class Admin_login_view
{
    use View_admin;
    public function show_login_page($message)
    { ?>
        <?php
        if ($message != "") echo "<div class='alert alert-danger mt-5 mb-5 w-50 mx-auto' role='alert'>" . decode_message($message) . "</div>";
        ?>
        <div class="title">Admin Login Page</div>
        <form id="form" method="POST" action="http://localhost/TDW_PROJECT/turboChoice/login_admin/login">
            <div class="forme">
                <label for="email"> Username</label>
                <input type="text" name="email" id="email" required><br>
                <label for="password"> Password</label>
                <input type="password" name="password" id="password" required><br>
                <button type="submit" id="send"> Sign in</button>
            </div>
        </form>

<?php
    }
}
