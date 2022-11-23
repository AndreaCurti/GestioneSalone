    <div class="container d-flex justify-content-center py-5 h-100 text-center">
        <div class="row align-items-center mb-5">
            <div class="col-lg-12" style="z-index: 10">
                <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Modifica utente
                </h1>
            </div>

            <div class="card bg-glass mb-5">
                <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                    <form action="<?php echo URL ?>users/modifyUser" method="POST">
                        <!-- Select user input -->
                        <div class="form-group mb-4">
                            <label for="selectUser" class="control-label pull-right">Scegli un utente</label>
                            <select name="idUser" id="selectUser" onchange="showUser(this.value)" class="form-select" style="background: transparent; color: #4f4f4f">
                                <?php if(isset($data['users'])){ foreach($data['users'] as $user): ?>
                                    <option value="<?php echo $user["id"]; ?>" <?php echo (isset($data['lastId']) && $data['lastId'] == $user["id"] ? "SELECTED" : ""); ?>><?php echo $user["email"]; ?></option>
                                <?php endforeach; }?>
                            </select>

                        </div><br>

                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" autocomplete="off" id="nameID" name="name" placeholder="Nome" <?php if(isset($data['lastName'])){ ?> value="<?php echo $data['lastName'] ?>"<?php } ?>/>
                        </div>

                        <!-- Surname input -->
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" autocomplete="off" id="surnameID" name="surname" placeholder="Cognome" <?php if(isset($data['lastSurname'])){ ?> value="<?php echo $data['lastSurname'] ?>"<?php } ?>/>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" class="form-control" autocomplete="off" id="emailID" name="email" placeholder="Email" <?php if(isset($data['lastEmail'])){ ?> value="<?php echo $data['lastEmail'] ?>"<?php } ?>/>
                        </div>

                        <!-- New password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" class="form-control" placeholder="Nuova password"/>
                        </div>

                        <!-- Confirm password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="confPassword" class="form-control" placeholder="Conferma password"/>
                        </div>

                        <!-- Submit button -->
                        <div class="form-outline w-50 mx-auto">
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                            Modifica
                            </button>
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
    <script>
        function showUser(id) {
        if (id=="") {
            return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                let data = JSON.parse(this.responseText);
                document.getElementById('nameID').value = data[0].name;
                document.getElementById('surnameID').value = data[0].surname;
                document.getElementById('emailID').value = data[0].email;

                const $select = document.querySelector('#mySelect');
                const $options = Array.from($select.options);
                const optionToSelect = $options.find(item => item.value === id);
                optionToSelect.selected = true;
            }
        }
        xmlhttp.open("GET","<?php echo URL ?>users/getSpecificUserInfo/"+id,true);
        xmlhttp.send();
        }
    </script>