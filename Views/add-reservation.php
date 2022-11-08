<?php
    include('header.php');
    require_once("validate-session.php");
    use Models\Reservation;
?>
<div class="container p-3 my-3 bg-dark text-white">
<form action="<?php echo FRONT_ROOT ."Reservation/add" ?>" method="post">
    <h2>Register your reservation</h2>
   
    <div>
        <p>This is the information for this Keeper</p>
        
        <td><?php echo $Keeper->getInitialDate()?></td>
        <td><?php echo $Keeper->getEndDate()?></td>
        <td><?php foreach($Keeper->getDays() as $day){echo $day;} ?></td>
        <td><?php echo $Keeper->getPetSize()?></td>
        <td><?php echo $Keeper->getPrice() ?></td>
        <p>Please select</p>
    </div> 
    
    <div class="form-outline mb-2">
        <input type="text" value="<?php echo $Keeper->getKeeperId() ?>" id="KeeperId" class="form-control" name="keeperId" placeholder="KeeperId" required hidden>
    </div>
    <div class="form-outline mb-2">
        <input type="text" value="<?php echo $pet->getId() ?>" id="petId" class="form-control" name="petId" required hidden>
    </div>
    
    <div class="form-outline mb-2">
        <label class="form-label" >InitialDate</label>
        <input type="date" id="InitialDate" class="form-control" name="InitialDate" placeholder="InitialDate" required>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >EndDate</label>
        <input type="date" id="EndDate" class="form-control" name="EndDate" placeholder="EndDate" required>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Type</label>
        <select class="form-control" name="days" id="days" required>
            <?php foreach($Keeper->getDays() as $day) { ?>
                <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Total Price</label>
        <input class="form-label" type="text" value="<?php echo $Keeper->getPrice() * count($Keeper->getDays()) ?>" id="totalPrice" class="form-control" name="totalPrice" required hidden>
        <h3><?php echo $Keeper->getPrice() * count($Keeper->getDays())?></h3>
    </div>

    <input type="submit" class="btn btn-primary" value="Add">
    <a href="<?php echo FRONT_ROOT ?>Home/ShowWelcomeView" class="btn btn-outline-danger">Cancel</a>                         
</form>
</div>