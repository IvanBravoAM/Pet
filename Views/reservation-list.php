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
                         </thead>
                         <tbody>
                         <?php
                    }
                         ?>
                         <?php
                         if (!empty($ReservationList)) {
                              foreach ($ReservationList as $Reservation) {
                         ?>
                            <form action="<?php echo FRONT_ROOT . "Reservation/Action" ?>" method="post">
                                <tr>
                                        <td>
                                            <a class="btn btn-info" href="<?php echo FRONT_ROOT . "Keeper/    ShowProfile/" . $Reservation->getIdKeeper() ?>">
                                            </a>
                                        </td>
                                        <td><?php echo $Reservation->getInitialDate()?></td>
                                        <td><?php echo $Reservation->getEndDate()?></td>
                                        <td><?php echo $Reservation->getDays()?></td>
                                        <td><?php echo $Reservation->getStatus()?></td>
                                        <td><?php echo $Reservation->gettotalPrice() ?></td>
                                        <td>
                                            <a class="btn btn-info" href="<?php echo FRONT_ROOT . "Reservation/ShowModifyView/" . $Reservation->getId() ?>">Modify
                                            </a>
                                            <button type="submit" name="inactivate" class="btn btn-danger" value="<?php echo $Reservation->getId() ?>">X</button>
                                            <?php if($_SESSION['loggedUser']->getUserType()=='Keeper'){?>
                                               <button type="submit" name="confirm" class="btn btn-info" value="<?php echo $Reservation->getId() ?>">Confirm</button> 
                                            <?php } ?>
                                            
                                        </td>
                                </tr>
                            </form>
                         <?php
                              }
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
          <div class="container p-3 my-3 bg-dark text-white">
            <form action="<?php echo FRONT_ROOT . "Reservation/showFilterListView" ?>" method="get">
                    <h3>Filter Reservations by date</h3>
                    Start Date
                    <input type="Date" name="initialDate" required> 
                    End Date
                    <input type="Date" name="endDate" required> 
                    <input class="btn btn-outline-info" type="submit" value="Filter">
                </form> 
            </div> 
          <div class="mb-3">
                <div>
                    <a class="btn btn-success" href="<?php echo FRONT_ROOT . "Reservation/ShowAddView" ?>">
                        Add New Reservation
                    </a>
                </div>
            </div>
     </section>
</main>