<?php
    include('header.php');
    include('nav-bar-owner.php');
    require_once("validate-session.php");
    use Models\PetType;
?>
<div class="container p-3 my-3 bg-dark text-white">
<form action="<?php echo FRONT_ROOT ."PetType/add" ?>" method="post">
    <h2>Register Pet Type</h2>
    <div class="form-outline mb-2">
        <label class="form-label" >Pet Type Name</label>
        <input type="PetName" id="PetName" class="form-control" name="PetName" placeholder="Pet Type" required> 
    </div>

    <input type="submit" class="btn btn-primary" value="Add">
    <a href="<?php echo FRONT_ROOT ?>Pet/ShowAddView" class="btn btn-outline-danger">Cancel</a>
</form>
</div>