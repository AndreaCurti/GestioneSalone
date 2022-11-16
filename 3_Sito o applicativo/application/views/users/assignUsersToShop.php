<div class="container d-flex justify-content-center py-5 h-100 text-center">
    <div class="row align-items-center mb-5 mx-5">
        <div class="col-lg-12" style="z-index: 10">
            <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Assegna un utente ad una succursale
            </h1>
            <h5 style="color: hsl(218, 81%, 95%)">
                Scegli un utente a cui assegnare la succursale in cui lavora
            </h5>
        </div>

        <div class="card bg-glass mb-5">
            <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                <form action="<?php echo URL ?>users/assignUserToShop" method="POST"">
                    <!-- Select user input -->
                    <div class="form-group mb-4">
                        <label for="selectUser" class="control-label pull-right h4">Scegli un utente</label><br><br>
                        <select name="idUser" id="selectUser" class="form-select" style="background: transparent; color: #4f4f4f">
                            <?php if(isset($data['users'])){ foreach($data['users'] as $user): ?>
                                <option value="<?php echo $user["id"]; ?>" <?php echo (isset($data['lastUserId']) && $data['lastUserId'] == $user["id"] ? "SELECTED" : ""); ?>><?php echo $user["email"]; ?></option>
                            <?php endforeach; }?>
                        </select>
                    </div><br>

                    <!-- Select shop input -->
                    <div class="form-group mb-4">
                        <label for="idShop" class="control-label pull-right h4">Scegli un negozio</label><br><br>
                        <select name="idShop" id="selectUser" class="form-select" style="background: transparent; color: #4f4f4f">
                            <?php if(isset($data['shops'])){ foreach($data['shops'] as $shop): ?>
                                <option value="<?php echo $shop["id"]; ?>" <?php echo (isset($data['lastShopId']) && $data['lastShopId'] == $shop["id"] ? "SELECTED" : ""); ?>><?php echo $shop["name"] . " | " . $shop['address']; ?></option>
                            <?php endforeach; }?>
                        </select>
                    </div><br>

                    <!-- Submit button -->
                    <div class="form-outline w-50 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block mb-4">Assegna</button>
                    </div>
                    <div class="form-outline d-flex justify-content-center">
                        <?php if(isset($data['error'])){ ?>
                            <label id="errorLogin" class="form-label alert alert-danger"> <?php echo $data['error'] ?></label>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


