<?php
    include('header.php');
    include('nav-bar-keeper.php');
    require_once("validate-session.php");
    use Models\PetType;
?>


<?php if(empty($message)){?>
                               
<div class="container p-3 my-3 bg-dark text-white">                             
<form action="<?php echo FRONT_ROOT ."Keeper/add" ?>" method="post">
    <h3>Activate your Keeper profile</h3>
    <div class="form-outline mb-2">
        <label class="form-label" >Pet Size</label>
        <select id="Size" class="form-control" name="Size" required>
        <option value="Small">Small</option>
        <option value="Medium">Medium</option>
        <option value="Big">Big</option>
        </select>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label">Type</label>
        <select class="form-control" name="petTypeId" id="petType" required>
            <?php foreach($petTypeList as $petType) { ?>
                <option  value="<?php echo $petType->getId() ?>"><?php echo $petType->getName() ?></option>
            <?php } ?>
        </select>
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
        <label class="form-label" >Days</label>
        <p>Use Shift or Control to multi select</p>
        <select class="form-control" multiple name="days[]" required="1" >
                <option value="monday">Monday</option>
                <option value="tuesday">Tuesday</option>
                <option value="wednesday">Wednesday</option>
                <option value="thursday">Thursday</option>
                <option value="friday">Friday</option>
                <option value="saturday">Saturday</option>
                <option value="sunday">Sunday</option>
        </select>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Price</label>
        <input type="number" id="Price" class="form-control" name="Price" placeholder="Price" required>
    </div>

    <input type="submit" class="btn btn-primary" value="Add">
    <a href="<?php echo FRONT_ROOT ?>Home/ShowWelcomeView" class="btn btn-outline-danger">Cancel</a>

                                

</form>
</div>

<?php }else{?> <div class="container-fluid"><p class = "alert alert-danger"><?php echo $message ?></p><?php  }?></div>