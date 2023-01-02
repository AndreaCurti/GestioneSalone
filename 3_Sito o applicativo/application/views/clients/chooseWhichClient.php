<div class="container d-flex justify-content-center py-5 h-100 text-center">
    <div class="row align-items-center mb-5">
        <div class="col-lg-12" style="z-index: 10">
            <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Scegli quale cliente gestire
            </h1>
        </div>

        <div class="card bg-glass mb-5">
            <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                <form action="<?php echo URL ?>clients/chooseWhichClient" method="POST">

                <!-- Select user input -->
                <div class="form-group mb-4">
                    <select name="idClient" id="selectClient" class="form-select" style="background: transparent; color: #4f4f4f">
                        <?php if(isset($data['clients'])){ foreach($data['clients'] as $client): ?>
                            <option value="<?php echo $client["id"]; ?>" <?php echo (isset($data['lastId']) && $data['lastId'] == $client["id"] ? "SELECTED" : ""); ?>><?php echo $client["email"]; ?></option>
                        <?php endforeach; }?>
                    </select>
                </div><br>

                <!-- Submit button -->
                <div class="form-outline w-50 mx-auto">
                    <button type="submit" class="btn btn-primary btn-block mb-4">Scegli</button>
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

