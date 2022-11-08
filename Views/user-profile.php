<?php
    include('header.php');
    if($_SESSION['loggedUser']->getUserType() == "Owner") include('nav-bar-owner.php');
    else include('nav-bar-keeper.php');
    require_once("validate-session.php");
?>
<div class="container p-3 my-3 bg-dark text-white">
<form action="<?php echo FRONT_ROOT."User/showModifyUserProfile" ?> " method="post">
    <table style="text-align:center;">
        <thead>
            <tr>
                <th style="width: 100px;">Username</th>
                <th style="width: 100px;">Nombre</th>
                <th style="width: 150px;">Apellido</th>
                <th style="width: 150px;">DNI</th>
                <th style="width: 150px;">Phone Number</th>
                <th style="width: 250px;">email</th>
                <th style="width: 150px;">User Type</th>
                <th style="width: 150px;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $user->getUsername() ?></td>
                <td><?php echo $user->getName() ?></td>
                <td><?php echo $user->getLastName() ?></td>
                <td><?php echo $user->getDNI() ?></td>
                <td><?php echo $user->getPhone() ?></td>
                <td><?php echo $user->getEmail() ?></td>
                <td><?php echo $user->getUserType() ?></td>
                <td><button type="submit"> Modify </button></td>
            </tr>
        </tbody>
    </table>
    <p>CAMBIAR FRONT</p>
</form>
</div>