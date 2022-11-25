<?php
include_once(VIEWS_PATH . "validate-session.php");
if($_SESSION['loggedUser']->getUserType() == "Owner") include('nav-bar-owner.php');
    else include('nav-bar-keeper.php');
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">My Reservations</h2>
               <?php
               if (!empty($ReservationList)) {
               ?>
                    <table class="table table-dark text-center">
                         <thead>
                              <th>Keeper Profile</th>
                              <th>Initial Date</th>
                              <th>End Date</th>
                              <th>Days</th>
                              <th>Reservation Status</th>
                              <th>Total Price</th>
                              <th>Actions</th>
                         </thead>
                         <tbody>
                         <?php
                    }
                         ?>
                         <?php
                         if (!empty($ReservationList)) {
                              foreach ($ReservationList as $Reservation) {if($Reservation->getStatus() != 'inactive'){
                         ?>
                            <form action="<?php echo FRONT_ROOT . "Reservation/Inactivate" ?>" method="post">
                                <tr>
                                        <td>
                                            <a class="btn btn-info" href="<?php echo FRONT_ROOT . "Keeper/showProfile/" . $Reservation->getIdKeeper() ?>">Show Keeper Profile
                                            </a>
                                        </td>
                                        <td><?php echo $Reservation->getInitialDate()?></td>
                                        <td><?php echo $Reservation->getEndDate()?></td>
                                        <td><?php echo $Reservation->getDays()?></td>
                                        <td><?php echo $Reservation->getStatus()?></td>
                                        <td><?php echo $Reservation->gettotalPrice() ?></td>
                                        <td>
                                        
                                        <button type="submit" name="inactivate" class="btn btn-danger" value="<?php echo $Reservation->getId() ?>">Delete</button>
                                            <?php if($_SESSION['loggedUser']->getUserType()=='Keeper'){?>
                                               <!-- <button type="submit" name="confirm" class="btn btn-info" value="<?php echo $Reservation->getId() ?>">Confirm</button>  -->
                                               <a class="btn btn-info" href="<?php echo FRONT_ROOT . "Reservation/Confirm/" . $Reservation->getId() ?>">Confirm</a>
                                            <?php } ?>
                                            
                                        </td>
                                </tr>
                            </form>
                         <?php
                              }}
                         } else {
                              echo "<div class='container alert alert-warning'>
                         <div class='content text-center'>
                              <p><strong>You do not have Reservations</strong></p>
                         </div>
                    </div>";
                         }
                         ?>
                         </tbody>
                    </table>
          </div>
     </section>
</main>