<div class="container d-flex justify-content-center py-5 h-100 text-center">
    <div class="row align-items-center mb-5">
        <div class="col-lg-12" style="z-index: 10">
            <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Aggiungi cliente
            </h1>
        </div>

        <div class="mb-5">
            <div class="card bg-glass">
                <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                    <form action="<?php echo URL ?>clients/addClient" method="POST">
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Nome" <?php if(isset($data['lastName'])){ ?> value="<?php echo $data['lastName'] ?>"<?php } ?>/>
                        </div>

                        <!-- Surname input -->
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" autocomplete="off" name="surname" placeholder="Cognome" <?php if(isset($data['lastSurname'])){ ?> value="<?php echo $data['lastSurname'] ?>"<?php } ?>/>
                        </div>

                        <!-- Address input -->
                        <div class="form-outline mb-4">
                            <input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email" <?php if(isset($data['lastEmail'])){ ?> value="<?php echo $data['lastEmail'] ?>"<?php } ?>/>
                        </div>

                        <!-- Phone input -->
                        <div class="form-outline mb-4">
                            <input type="number" class="form-control" autocomplete="off" name="number" placeholder="Number" <?php if(isset($data['lastNumber'])){ ?> value="<?php echo $data['lastNumber'] ?>"<?php } ?>/>
                        </div>


                        <!-- Submit button -->
                        <div class="form-outline w-50 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Crea
                            </button>
                        </div>

                        <div class="form-outline d-flex justify-content-center">
                            <?php if(isset($data['error'])){ ?>
                                <label id="error" class="form-label alert alert-danger"> <?php echo $data['error'] ?></label>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
