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
                            <form action="<?php echo FRONT_ROOT?>User/Add" method="post">
                                <h3>New account</h3>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >Username</label>
                                    <input type="username" id="username" class="form-control" name="username" placeholder="username" required> 
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >Password</label>
                                    <input type="password" id="password" class="form-control" name="password" placeholder="password" required>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >First Name</label>
                                    <input type="text" id="firstName" class="form-control" name="firstName" placeholder="first name" required>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >Last Name</label>
                                    <input type="text" id="lastName" class="form-control" name="lastName" placeholder="last name" required>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >DNI</label>
                                    <input type="text" id="dni" class="form-control" name="dni" placeholder="dni" required>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >Phone</label>
                                    <input type="text" id="phone" class="form-control" name="phone" placeholder="phone number" required>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >Email</label>
                                    <input type="email" id="email" class="form-control" name="email" placeholder="email" required>
                                </div>
                                <div class="form-outline mb-2">
                                    <label class="form-label" >Role</label>
                                    <select id="userType" class="form-control" name="userType" required>
                                    <option value="Owner">Owner</option>
                                    <option value="Keeper">Keeper</option>
                                    </select>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Sign Up">
                                <a href="<?php echo FRONT_ROOT ?>Home/Index" class="btn btn-outline-danger">Cancel</a>
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
