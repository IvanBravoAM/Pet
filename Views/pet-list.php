<?php
include_once(VIEWS_PATH . "validate-session.php");
include_once(VIEWS_PATH . "nav-bar-owner.php");
?>
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
          <?php if(!empty($message)){?> <div class="container-fluid"><p class = "alert alert-danger"><?php echo $message ?></p></div><?php  }?>
               <h2 class="mb-4">My Pets</h2>
               <?php
               if (!empty($petList)) {
               ?>
                    <table class="table table-dark text-justified">
                         <thead>
                              <th>Name</th>
                              <th>PetType</th>
                              <th>Breed</th>
                              <th>PetSize</th>
                              <th>Observation</th>
                              <th>Picture</th>
                              <th>Vacunation</th>
                              <th>Video</th>
                              <th>Actions</th>
                         </thead>
                         <tbody>
                         <?php
                    }
                         ?>
                         <?php
                         if (!empty($petList)) {
                            foreach ($petList as $pet) {if($pet->getIsActive() == 'true'){
                         ?>
                            <form action="<?php echo FRONT_ROOT . "Pet/Inactivate" ?>" method="post">
                                <tr>
                                        <td><?php echo $pet->getName() ?></td>
                                        <?php foreach ($petTypeList as $petType) {
                                             if($petType->getId() == $pet->getPetType()->getId()){?>
                                             <td><?php echo $petType->getName()?></td><?php }}
                                        ?>
                                        <td><?php echo $pet->getBreed()?></td>
                                        <td><?php echo $pet->getSize()?></td>
                                        <td><?php echo $pet->getDescription() ?></td>
                                        <td>
                                            <?php
                                            if($pet->getPhoto() != null){?>
                                             <a href="<?php echo $pet->getPhoto()?>" target="_blank"><img src="<?php echo $pet->getPhoto()?>" alt="alternatetext" style="width:60px;height:60px;"></a><?php }
                                            else {echo "There is currently no image";}
                                            ?>
                                        </td>
                                        <td>
                                             <?php
                                            if($pet->getVaccines() != null){?>
                                             <a href="<?php echo $pet->getVaccines()?>" target="_blank"><img src="<?php echo $pet->getVaccines()?>" alt="alternatetext" style="width:60px;height:60px;"></a><?php }
                                            else {echo "There is currently no vaccines";}
                                            ?>
                                        </td>
                                        <td>
                                             <?php
                                            if($pet->getVideo() != null){?>
                                             <a href="<?php echo $pet->getVideo()?>" target="_blank">Watch Video</a><?php }
                                            else {echo "There is currently no image";}
                                            ?>
                                        </td>
                                        <td>
                                        
                                            <a class="btn btn-info" href="<?php echo FRONT_ROOT . "Pet/ShowModifyView/" . $pet->getId() ?>">Modify</a>
                                            <button type="submit" name="inactivate" class="btn btn-danger" value="<?php echo $pet->getId() ?>">Inactivate</button>
                                        </td>
                                   </tr>
                                
                            </form>
                            
                         <?php
                              }}
                         } else {
                              echo "<div class='container alert alert-warning'>
                         <div class='content text-center'>
                              <p><strong>Your Pet list is empty</strong></p>
                         </div>
                    </div>";
                         }
                         ?>
                         </tbody>
                    </table>
          </div>
          <div class="mb-3">
                <div>
                    <a class="btn btn-success" href="<?php echo FRONT_ROOT . "Pet/ShowAddView" ?>">
                        Add New Pet
                    </a>
                </div>
            </div>
     </section>
</main>