<?php
    include('header.php');
    include('nav-bar-owner.php');
    require_once("validate-session.php");
    use Models\PetType;
?>
<?php if(!empty($message)){?> <div class="container-fluid"><p class = "alert alert-danger"><?php echo $message ?></p></div><?php  }?>
<div class="container p-3 my-3 bg-dark text-white">
<form action="<?php echo FRONT_ROOT ."Pet/Update" ?>" method="post">
    <h2>Update Pet</h2>
    <input type="PetId" id="PetId" class="form-control" name="PetId" value="<?php echo $pet->getId() ?>" required hidden> 
    <div class="form-outline mb-2">
        <label class="form-label" >Pet Name</label>
        <input type="PetName" id="PetName" class="form-control" name="PetName" value="<?php echo $pet->getName() ?>" required> 
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Breed</label>
        <input type="text" id="Breed" class="form-control" name="Breed" placeholder="Breed" value= "<?php echo $pet->getBreed() ?>" required>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Pet Size</label>
        <select id="Size" class="form-control" name="Size" required>
        <option selected value="<?php echo $pet->getSize()?>"><?php echo $pet->getSize()?> </option>
        <option value="Small">Small</option>   
        <option value="Medium">Medium</option>
        <option value="Big">Big</option>
        </select>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Description</label>
        <input type="text" id="Description" class="form-control" name="Description" value= "<?php echo $pet->getDescription() ?>" required>
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Photo</label>
        <input type="text" id="Photo" class="form-control" name="Photo" value= "<?php echo $pet->getPhoto() ?>" placeholder="Photo"  >
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Vaccines</label>
        <input type="text" id="Vaccines" class="form-control" name="Vaccines" value= "<?php echo $pet->getVaccines() ?>" placeholder="Vaccines"  >
    </div>
    <div class="form-outline mb-2">
        <label class="form-label" >Video</label>
        <input type="text" id="Video" class="form-control" name="Video" value= "<?php echo $pet->getVideo() ?>" placeholder="Video"  >
    </div>
    <div class="form-outline mb-2">
        <label class="form-label">Type</label>
        <select class="form-control" name="petTypeId" id="petType" required>
            <option selected value="<?php echo $pet->getPetType()->getId() ?>"><?php echo $pet->getPetType()->getName() ?></option>
            <?php foreach($petTypeList as $petType) { ?>
                <option  value="<?php echo $petType->getId() ?>"><?php echo $petType->getName() ?></option>
            <?php } ?>
        </select>
    </div>

    <input type="submit" class="btn btn-primary" value="Update">
    <a href="<?php echo FRONT_ROOT ?>Pet/ShowPetListView" class="btn btn-outline-danger">Cancel</a>
</form>
</container>