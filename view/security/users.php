<?php
    $users = $result["data"]['users'];
?>

<h1>Members List</h1>

<?php
foreach($users as $user){
?>
    <p>
        <img src="public/img/<?=$user->getAvatar()?>">
        <a class='links' href="index.php?ctrl=forum&action=detailUser&id=<?=$user->getId()?>"><?=$user->getUsername()?></a>
        <?=$user->getRegistrationdate()?>
        <form action="index.php?ctrl=security&action=deleteUser&id=<?=$user->getId()?>" method="post">
            <input type="submit" name="deleteUser" value="Delete User">
        </form>
    </p>
<?php
}
?>