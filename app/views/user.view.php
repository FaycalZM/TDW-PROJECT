<?php

class UserView
{
    use View;

    public function show_login_form($message = "")
    { ?>
        <?php

        if ($message != "") {
            echo "<div class='alert alert-danger mt-5 mb-5 w-50 mx-auto' role='alert'>" . decode_message($message) . "</div>";
        }
        ?>
        <section class="form-container">
            <h2 style="text-align: center;">Login</h2>
            <form id="login_form" method="POST" action="<?= ROOT ?>/user/login">
                <div class="input">
                    <label> Username</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input">
                    <label> Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="input btns">
                    <button class="primary-btn" type="submit" id="signin-btn"> Sign in</button>
                    <p>you don't have an account? <a class="secondary-btn" href="<?= ROOT ?>/user/show_signup_page">Sign up</a></p>
                </div>
            </form>
        </section>
    <?php
    }

    public function show_signup_form($message = "")
    {
        if ($message != "") {
            echo "<div class='alert alert-danger mt-5 mb-5 w-50 mx-auto' role='alert'>" . decode_message($message) . "</div>";
        } ?>
        <section class="form-container">
            <h2 style="text-align: center;">Sign up</h2>
            <form id="signup_form" action="<?= ROOT ?>/user/signup" method="POST">
                <div class="input">
                    <label for="firstName">first name</label>
                    <input required type="text" id="firstName" name="firstName">
                </div>
                <div class="input">
                    <label for="lastName">last name</label>
                    <input required type="text" name="lastName" id="lastName">
                </div>
                <div class="input">
                    <label for="email">Email</label>
                    <input required type="email" name="email" id="email">
                </div>
                <div class="input">
                    <label for="sex">Sex</label>
                    <div style="margin-top: 5px;">
                        <select required id="sex" name="sex">
                            <option selected>choose your sex</option>
                            <option value="M">Male</option>
                            <option value="F">Femelle</option>
                        </select>
                    </div>
                </div>
                <div class="input">
                    <label for="birthDate">Date of birth</label>
                    <input required type="date" name="birthDate" id="birthDate">
                </div>
                <div class="input">
                    <label for="password">Password</label>
                    <input required type="password" name="password" id="password">
                </div>
                <div class="input">
                    <label for="conf_pwd">Confirm your password</label>
                    <input required type="password" name="conf_pwd" id="conf_pwd">
                </div>

                <button id="signup-btn" class="primary-btn" type="submit">Sign up</button>
            </form>
        </section>

    <?php
    }

    public function show_profile()
    { ?>

<?php
    }
}
