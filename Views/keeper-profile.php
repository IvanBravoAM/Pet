<?php
    include('header.php');
    include('nav-bar-keeper.php');
    require_once("validate-session.php");
?>

<div class="container p-3 my-3 bg-dark text-white">
  <h2>Keeper Profile  </h2>
    <div class="col-lg-8" ">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3" style="color: black;">
                <p class="mb-0">Pet Size</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getPetSize()?></p>
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3" style="color: black;">
                <p class="mb-0">Initial Date</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getInitialDate() ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3" style="color: black;">
                <p class="mb-0" col>End Date</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getEndDate() ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3" style="color: black;">
                <p class="mb-0">Days</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php foreach($keeper->getDays() as $day){echo ucfirst($day); echo "<br>";} ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-sm-3" style="color: black;">
                <p class="mb-0">Price</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $keeper->getPrice()?></p>
              </div>
            </div>
          </div>
        </div>
        </div>
    <p>CAMBIAR FRONT</p>
</div>