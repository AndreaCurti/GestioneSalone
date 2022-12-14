    <div class="container d-flex justify-content-center py-5 h-100 text-center">
        <div class="row align-items-center mb-5">
            <div class="col-lg-12" style="z-index: 10">
                <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Modifica prodotto
                </h1>
            </div>

            <div class="card bg-glass mb-5">
                <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                    <form action="<?php echo URL ?>products/modifyProduct" method="POST">
                        <!-- Select user input -->
                        <div class="form-group mb-4">
                            <label for="selectProduct" class="control-label pull-right">Scegli un prodotto</label>
                            <select name="idProduct" id="selectProduct" onchange="showProduct(this.value)" class="form-select" style="background: transparent; color: #4f4f4f">
                                <?php if(isset($data['products'])){ foreach($data['products'] as $product): ?>
                                    <option value="<?php echo $product["id"]; ?>" <?php echo (isset($data['lastId']) && $data['lastId'] == $product["id"] ? "SELECTED" : ""); ?>><?php echo $product["name"]; ?></option>
                                <?php endforeach; }?>
                            </select>

                        </div><br>

                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" class="form-control" autocomplete="off" id="nameID" name="name" placeholder="Nome" <?php if(isset($data['lastName'])){ ?> value="<?php echo $data['lastName'] ?>"<?php } ?>/>
                        </div>

                        <!-- Surname input -->
                        <div class="form-outline mb-4">
                            <input type="number" id="costID" step="0.01" min="0.1" class="form-control" autocomplete="off" name="cost"
                                   placeholder="Costo" <?php if(isset($data['lastCost'])){ ?> value="<?php echo $data['lastCost'] ?>"<?php } ?>/>
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
        function showProduct(id) {
        if (id=="") {
            return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                let data = JSON.parse(this.responseText);
                document.getElementById('nameID').value = data[0].name;
                document.getElementById('costID').value = data[0].cost;

                const $select = document.querySelector('#mySelect');
                const $options = Array.from($select.options);
                const optionToSelect = $options.find(item => item.value === id);
                optionToSelect.selected = true;
            }
        }
        xmlhttp.open("GET","<?php echo URL ?>products/getSpecificProductInfo/"+id,true);
        xmlhttp.send();
        }
    </script>
