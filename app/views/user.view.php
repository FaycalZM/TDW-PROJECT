<?php

class UserView
{
    use View;

    public function show_login_form($message = "")
    { ?>
        <?php
        if ($message != "") echo "<div role='alert'>" . $message . "</div>";
        ?>
        <div>Login Page</div>
        <form id="login_form" method="POST" action="<?= ROOT ?>/user/login">
            <div>
                <label> Username</label>
                <input type="email" name="email" id="email" required><br>
                <label> Password</label>
                <input type="password" name="password" id="password" required><br>
                <button type="submit" id="send"> Sign in</button>
                <a href="<?= ROOT ?>/user/show_signup_page&message=">Signup</a>
            </div>
        </form>
        <script>
            setTimeout(() => {
                $("div[role='alert']").hide();
            }, 3000);
        </script>
    <?php
    }

    public function show_signup_form($message = "")
    {
        if ($message != "") echo "<div role='alert'>" . $message . "</div>"; ?>
        <div>Registration Page</div>
        <form action="<?= ROOT ?>/user/signup" method="post">
            <div>
                <label for="name">Nom</label>
                <input required type="text" id="name" name="name">
            </div>
            <div>
                <label for="prenom">Prenom</label>
                <input required type="text" name="prenom" id="prenom">
            </div>
            <div>
                <label for="email">Email</label>
                <input required type="email" name="email" id="email">
            </div>
            <div>
                <label for="sexe">Sexe</label>
                <select required id="sexe" name="sexe">
                    <option selected>Choissir le sexe</option>
                    <option value="m">Male</option>
                    <option value="f">Femelle</option>
                </select>
            </div>
            <div>
                <label for="data_naissance">Date de naissance</label>
                <input required type="date" name="data_naissance" id="data_naissance">
            </div>
            <div>
                <label for="password">Mot de passe</label>
                <input required type="password" name="password" id="password">
            </div>
            <div>
                <label for="conf_password">Confirmation de mot de passe</label>
                <input required type="password" name="conf_password" id="conf_password">
            </div>
            <div>
                <button type="submit">Envoyer </button>
            </div>
        </form>
        <script>
            setTimeout(() => {
                $("div[role='alert']").hide();
            }, 3000);
        </script>
    <?php
    }

    public function show_profile()
    { ?>

<?php
    }
}
