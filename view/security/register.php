<main>
    <section class="section_register">

        <h1>Register new Account</h1>
        
            <div class="register_wrapper">
                <form class='formular_base' action="index.php?ctrl=security&action=register" method="post">
                    
                    <div class="username">
                        <label class="username" for="username">Username :</label>
                        <input type="text" name="username" id="username" required>
                    </div>
        
                    <div class="email">
                        <label class="email" for="email">E-mail Adress :</label>
                        <input name="email" type="email" id="email" required="1"><br/>
                        <label class="emailConfirm" for="emailConfirm">Confirm E-mail Adress :</label>
                        <input name="emailConfirm" type="email" id="confEmail" onblur="confirmEmail()">
                    </div>
                    <div class="password">
                        <label class="pass" for="pass">Password (8 characters minimum):</label>
                        <input type="password" id="pass" name="password" required>
                        <input type="checkbox" onclick="togglePassword()">Show Password<br/>
                        <div class="confirmPassword">
                            <label for="confPass">Confirm Password:</label>
                            <input type="password" id="confPass" name="confirmPassword" onblur="confirmPassword()">
                        </div>
                    </div>

                    <input id="submitRegister" type="submit" name="register" value="register">
                </form>
            </div>
        
        </section>
</main>
<script type ="text/javascript" src="public/js/formsActions.js"></script>

