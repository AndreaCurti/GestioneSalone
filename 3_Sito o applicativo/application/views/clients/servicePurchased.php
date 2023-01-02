<div class="container d-flex justify-content-center py-5 h-100 text-center">
    <div class="row align-items-center mb-5">
        <div class="col-lg-12" style="z-index: 10">
            <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Servizi effettuati
            </h1>
        </div>

        <div class="mb-5">
            <div class="card bg-glass">
                <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                    <div class="form-group mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome servizio</th>
                                    <th scope="col">Costo</th>
                                    <th scope="col">metodo di pagamento</th>
                                    <th scope="col">data</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(isset($data['servicePurchased']) && (is_array($data['servicePurchased']) || is_object($data['servicePurchased']))){ foreach($data['servicePurchased'] as $servicePurchased): ?>
                                    <tr>
                                        <th><?php echo $servicePurchased["service_name"];?></th>
                                        <th><?php echo $servicePurchased["service_cost"];?></th>
                                        <th><?php echo $servicePurchased["method_name"];?></th>
                                     <th><?php echo $servicePurchased["date"];?></th>
                                    </tr>
                                <?php endforeach; }?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
