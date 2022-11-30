<div class="container d-flex justify-content-center py-5 h-100 text-center">
    <div class="row align-items-center mb-5">
        <div class="col-lg-12" style="z-index: 10">
            <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Modifica cliente
            </h1>
        </div>

        <div class="card bg-glass mb-5">
            <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                <form action="<?php echo URL ?>clients/modifyClient" method="POST">
                    <!-- Select user input -->
                    <div class="form-group mb-4">
                        <label for="selectAdmin" class="control-label pull-right">Scegli un cliente</label>
                        <select name="idClient" id="selectClient" onchange="showClient(this.value)" class="form-select" style="background: transparent; color: #4f4f4f">
                            <?php if(isset($data['clients'])){ foreach($data['clients'] as $client): ?>
                                <option value="<?php echo $client["id"]; ?>" <?php echo (isset($data['lastId']) && $data['lastId'] == $client["id"] ? "SELECTED" : ""); ?>><?php echo $client["email"]; ?></option>
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

                    <!-- Phone input -->
                    <div class="form-outline mb-4">
                        <input type="number" class="form-control" autocomplete="off" id="phoneID" name="number" placeholder="Number" <?php if(isset($data['lastNumber'])){ ?> value="<?php echo $data['lastNumber'] ?>"<?php } ?>/>
                    </div>


                    <!-- Submit button -->
                    <div class="form-outline w-50 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block mb-4">
                            Modifica
                        </button>
                    </div>
                    <div class="form-outline d-flex justify-content-center">
                        <?php if(isset($data['error'])){ ?>
                            <label id="error" class="form-label alert alert-danger"> <?php echo $data['error'] ?></label>
                        <?php }else{ ?>
                            <label id="error" class="form-label alert alert-danger" style="display: none"></label>
                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function onloadFunction() {
        var e = document.getElementById("selectClient");
        var value = e.value;
        showClient(value);
    }

    function showClient(id) {
        if (id=="") {
            return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                let data = JSON.parse(this.responseText);
                if(Array.isArray(data)){
                    document.getElementById('nameID').value = data[0].name;
                    document.getElementById('surnameID').value = data[0].surname;
                    document.getElementById('emailID').value = data[0].email;
                    document.getElementById('phoneID').value = data[0].phone;

                    document.getElementById('error').style.display = "none";

                    const $select = document.querySelector('#selectAdmin');
                    const $options = Array.from($select.options);
                    const optionToSelect = $options.find(item => item.value === id);
                    optionToSelect.selected = true;
                }else{
                    document.getElementById('error').style.display = "inline";
                    document.getElementById('error').innerHTML = data;
                    document.getElementById('nameID').value = "";
                    document.getElementById('surnameID').value = "";
                    document.getElementById('emailID').value = "";
                    document.getElementById('phoneID').value = "";
                }
            }
        }
        xmlhttp.open("GET","<?php echo URL ?>clients/getSpecificClientInfo/"+id,true);
        xmlhttp.send();
    }
</script>
