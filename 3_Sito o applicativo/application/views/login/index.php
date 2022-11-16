<section class="background-radial-gradient overflow-hidden">
    <div class="container d-flex justify-content-center px-4 py-5 px-md-5 h-100 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
            <div class="col-auto mb-3 mb-lg-0 position-relative">
                <div id="radius-shape-1" style="z-index: 0" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" style="z-index: 0" class="position-absolute shadow-5-strong"></div>

                <div style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        Gestione salone
                    </h1>
                </div>

                <div class="card bg-glass">
                    <div class="card-body px-4 pt-5 pb-4 px-md-5">
                        <form action="<?php echo URL ?>login/loginUser" method="POST">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" class="form-control" autocomplete="off" id="loginemail" name="email"
                                       placeholder="Email" <?php if (isset($data['error'])) { ?> value="<?php echo $data['lastEmail'] ?>"<?php } ?>/>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="password" class="form-control" placeholder="Password"/>
                            </div>

                            <!-- Submit button -->
                            <div class="form-outline d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Accedi
                                </button>
                            </div>

                            <div class="form-outline d-flex justify-content-center">
                                <?php if (isset($data['error'])) { ?>
                                    <label id="errorLogin"
                                           class="form-label alert alert-danger"> <?php echo $data['error'] ?></label>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
