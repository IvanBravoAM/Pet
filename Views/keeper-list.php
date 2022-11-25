<?php
include_once(VIEWS_PATH . "validate-session.php");
include_once(VIEWS_PATH . "nav-bar-owner.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Keepers List</h2>
               <?php
               if (!empty($keeperList)) {
               ?>
                    <table class="table table-dark text-center">
                         <thead>
                              <th>Keeper Profile</th>
                              <th>Initial Date</th>
                              <th>End Date</th>
                              <th>Days</th>
                              <th>Keeper Size</th>
                              <th>Price</th>
                              <th>Actions</th>
                         </thead>
                         <tbody>
                         <?php
                    }
                         ?>
                         <?php
                         if (!empty($keeperList)) {
                              foreach ($keeperList as $Keeper) {
                         ?>
                            <form action="<?php echo FRONT_ROOT . "Keeper/Inactivate" ?>" method="post">
                                <tr>
                                        <td>
                                            <a class="btn btn-light" href="<?php echo FRONT_ROOT . "Keeper/ShowProfile/" . $Keeper->getKeeperId() ?>">View Keeper Profile
                                            </a>
                                        </td>
                                        <td><?php echo $Keeper->getInitialDate()?></td>
                                        <td><?php echo $Keeper->getEndDate()?></td>
                                        <td><?php foreach($Keeper->getDays() as $day){echo ucfirst($day); echo "<br>";} ?></td>
                                        <td><?php echo $Keeper->getPetSize()?></td>
                                        <td><?php echo $Keeper->getPrice() ?></td>
                                        <td>
                                            <a class="btn btn-info" href="<?php echo FRONT_ROOT . "Reservation/ShowAddView/" . $Keeper->getKeeperId() ?>">Add Reservation
                                        </td>
                                </tr>
                            </form>
                         <?php
                              }
                         } else {
                              echo "<div class='container alert alert-warning'>
                         <div class='content text-center'>
                              <p><strong>No Keepers found</strong></p>
                         </div>
                    </div>";
                         }
                         ?>
                         </tbody>
                    </table>
          
          <form action="<?php echo FRONT_ROOT . "Keeper/showFilterListView" ?>" method="get"> 
                  Initial Date Disponibily <input type="Date" name="initialDate" required> <br>
                  End Date Disponibily <input type="Date" name="endDate" required> <br>
                  <input type="submit" value="FILTER">
            </form> <br></div>
     </section>
</main>