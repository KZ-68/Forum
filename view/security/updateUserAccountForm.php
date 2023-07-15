<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Account Informations</title>
</head>
<body>
    <main>
        <section class="section_updateUserAccount">

            <h1>Modify Account Informations</h1>
            
                <div class="updateUserAccount_wrapper">
                    <form class='formular_base' action="index.php?ctrl=security&action=updateUserPassword&id=<?=App\Session::getUser()->getId()?>" method="post">
                        
                        <div class="password">
                            <div class="oldPassword">
                                <label class="password" for="password">Password (8 characters minimum):</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            
                            <label class="pass" for="pass">New Password (8 characters minimum):</label>
                            <input type="password" id="pass" name="newPassword" required>
                            <input type="checkbox" onclick="togglePassword()">Show Password<br/>
                            
                            <div class="update-confirmPassword">
                                <label for="confPass">Confirm Password:</label>
                                <input type="password" id="confPass" name="confirmPassword" onblur="confirmPassword()">
                            </div>
                        </div>

                        <input id="submit" type="submit" name="update" value="update">
                    </form>
                </div>
            
            </section>
    </main>
    <script type ="text/javascript" src="public/js/formsActions.js"></script>
</body>

</html>