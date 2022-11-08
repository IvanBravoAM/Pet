<?php
include('header.php');

?>
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
            <div class="card rounded-3 text-black">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <img class="logo"
                                        style="width: 185px;" alt="logo">
                                <h4 class="mt-1 mb-5 pb-1">Pet Hero test</h4>
                            </div>
                            <?php if(!empty($message)){?>
                                <p class = "alert alert-danger"><?php echo $message ?></p>
                                <?php } ?>
                            <form action="<?php echo FRONT_ROOT . "Home/Login"?>" method="post">
                                <div class="form-outline mb-4">
                                    <label class="form-label" >Username</label>
                                    <input type="text" name="userName" class="form-control"
                                            placeholder="User name" required/>
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example22">Password</label>
                                    <input type="password" name="password" class="form-control" required/>
                                </div>

                                <div class="text-center pt-1 mb-5 pb-1">
                                    <button class="btn btn-primary btn-block" type="submit">Log In</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-outline-info btn-block"
                                            onclick="location.href='<?php echo FRONT_ROOT . "User/ShowAddView" ?>'">Create new account</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-lg-6 d-flex">
                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                            <p class="small mb-0"> Test text
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
