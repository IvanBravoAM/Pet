<?php
    include('header.php');
    include('nav-bar-owner.php');
    require_once("validate-session.php");
    use Models\PetType;
?>
<?php if(!empty($message)){?> <div class="container-fluid"><p class = "alert alert-danger"><?php echo $message ?></p></div><?php  }?>
<div class="container p-3 my-3 bg-dark text-white">
<form action="<?php echo FRONT_ROOT ."Pet/Add" ?>" method="post">
    <h2>Register Pet</h2>
    <div class="form-outline mb-2">
        <label class="form-label" >Pet Name</label>
        <input type="PetName" id="PetName" class="form-control" name="PetName" placeholder="PetName" required> 
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Breed</label>
        <input type="text" id="Breed" class="form-control" name="Breed" placeholder="Breed" required>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Pet Size</label>
        <select id="Size" class="form-control" name="Size" required>
        <option value="Small">Small</option>
        <option value="Medium">Medium</option>
        <option value="Big">Big</option>
        </select>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Desciption</label>
        <input type="text" id="Desciption" class="form-control" name="Desciption" placeholder="Desciption" required>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label">Type</label>
        <select class="form-control" name="petTypeId" id="petType" required>
            <?php foreach($petTypeList as $petType) { ?>
                <option  value="<?php echo $petType->getId() ?>"><?php echo $petType->getName() ?></option>
            <?php } ?>
        </select>
        <a href="<?php echo FRONT_ROOT ?>PetType/ShowAddView" class="btn btn-outline-info">Add Type</a>
    </div>

    <input type="submit" class="btn btn-primary" value="Add">
    <a href="<?php echo FRONT_ROOT ?>Home/ShowWelcomeView" class="btn btn-outline-danger">Cancel</a>
</form>
</container>
