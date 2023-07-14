<?php

$user = $result["data"]['user'];

?>

<button class="home-btn"><a href="index.php?ctrl=security&action=updateUserAccountForm&id=<?=App\Session::getUser()->getId()?>">Settings</a></button></br>

<img src="public/img/<?=$user->getAvatar()?>">
<form action="index.php?ctrl=forum&action=changeAvatar&id=<?=$user->getId()?>" method="post">
<label>Change Avatar: </label><br/>
<input type="file" id="avatar" name="avatar">
<input id="submit" type="submit" name="changeAvatar" value="Confirm">
</form>


<p>User Name : <?=$user->getUsername()?></p>
<p>Registration Date : <?=$user->getRegistrationdate()?></p>
<p>Email Adress : <?=$user->getEmail()?></p>
<?php
if (App\Session::getUser()->hasRole("ROLE_USER")) {
?>
<p>Role : User</p>
<?php
} else if (App\Session::isAdmin()) {
?>
<p>Role : Administrator</p> 
<?php
}
?>


<button class="home-btn"><a href="index.php?ctrl=home&action=home.php">Return Home</a></button>