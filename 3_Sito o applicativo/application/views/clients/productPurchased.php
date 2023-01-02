<div class="container d-flex justify-content-center py-5 h-100 text-center">
    <div class="row align-items-center mb-5">
        <div class="col-lg-12" style="z-index: 10">
            <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Prodotti acquistati
            </h1>
        </div>

        <div class="mb-5">
            <div class="card bg-glass">
                <div class="card-body px-4 pt-5 pb-4 px-md-5 ">
                    <div class="form-group mb-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome prodotto</th>
                                    <th scope="col">Costo</th>
                                    <th scope="col">metodo di pagamento</th>
                                    <th scope="col">data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($data['productPurchased']) && (is_array($data['productPurchased']) || is_object($data['productPurchased']))){ foreach($data['productPurchased'] as $productPurchased): ?>
                                    <tr>
                                        <th><?php echo $productPurchased["product_name"];?></th>
                                        <th><?php echo $productPurchased["product_cost"];?></th>
                                        <th><?php echo $productPurchased["method_name"];?></th>
                                     <th><?php echo $productPurchased["date"];?></th>
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
