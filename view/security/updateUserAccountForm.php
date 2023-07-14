<?php
    $user = $result["data"]['user'];
?>

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
                    <form class='formular_base' action="index.php?ctrl=forum&action=updateUserPassword&id=<?=$user->getId()?>" method="post">
                        
                        <div class="password">
                            <div class="oldPassword">
                                <label class="oldPassord" for="oldPassord">Password (8 characters minimum):</label>
                                <input type="password" id="oldPassord" name="oldPassword" required>
                                <input type="checkbox" onclick="togglePassword()">Show Password<br/>
                            </div>
                            
                            <label class="pass" for="pass">New Password (8 characters minimum):</label>
                            <input type="password" id="pass" name="password" required>
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
</body>

</html>