<?php
    include('header.php');
    include('nav-bar-keeper.php');
    require_once("validate-session.php");
?>

<div class="container p-3 my-3 bg-dark text-white">
<form action="<?php echo FRONT_ROOT."Keeper/showModifyView" ?> " method="post">
    <table style="text-align:center;">
        <thead>
            <tr>
                <th style="width: 150px;">Pet Size</th>
                <th style="width: 100px;">Initial Date</th>
                <th style="width: 100px;">End Date</th>
                <th style="width: 150px;">Days</th>
                <th style="width: 150px;">Price</th>
                <th style="width: 100px;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $keeper->getPetSize()?></td>
                <td><?php echo $keeper->getInitialDate() ?></td>
                <td><?php echo $keeper->getEndDate() ?></td>
                <td><?php foreach($keeper->getDays() as $day){echo $day;} ?></td>
                <td><?php echo $keeper->getPrice()?></td>
                <td><button type="submit"> Modify </button></td>
            </tr>
        </tbody>
    </table>
    <p>CAMBIAR FRONT</p>
</form>
</div>