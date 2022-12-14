<!-- LISTA HOME PAGE ADMIN -->
<style>
  .gradient-custom:hover {
    /* fallback for old browsers */
    background: #000000;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to top, rgba(0, 0, 0, 0.1), rgba(255, 255, 255, 0.1));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to top, rgba(0, 0, 0, 0.1), rgba(255, 255, 255, 0.1))
  }
</style>

<div class="container py-5">
    <!-- For demo purpose -->
    <div class="text-center" style="height:200px">
        <div class="mask">
            <br><br><br><br>
            <div class="h-100">
                <div class="col-lg-12 mt-5" style="z-index: 10">
                    <h1 class="display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                    Funzionalità disponibili
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End -->

    <div class="row">
        <div class="col-lg-6 mx-auto">

        <!-- List group-->
        <ul class="list-group">
            <!-- list group item-->
            <a class="text-decoration-none rounded mb-3" href="<?php echo URL; ?>clients">
            <li class="list-group-item">
                <!-- Custom content-->
                <div class="media align-items-lg-center py-1">
                <div class="media-body">
                    <h4 class="mt-0 font-weight-bold mb-2">Gestione clienti</h4>
                    <p class="font-italic text-muted mb-0 small">Aggiungi, modifica, elimina i clienti.</p>
                </div>
                <img src="<?php echo URL; ?>application/public/img/shop-management.png" alt="Gestione succursali" width="130" class="rounded mx-auto mt-4 d-block ml-lg-5">
                <div class="mask gradient-custom"></div>
                </div>
                <!-- End -->
            </li>
            <!-- End -->
            </a>


            <!-- list group item-->
            <a class="text-decoration-none rounded mb-3" href="<?php echo URL; ?>products">
            <li class="list-group-item">
                <!-- Custom content-->
                <div class="media align-items-lg-center py-1">
                <div class="media-body">
                    <h4 class="mt-0 font-weight-bold mb-2">Gestione prodotti</h4>
                    <p class="font-italic text-muted mb-0 small">Aggiungi, modifica, elimina i prodotti.</p>
                </div>
                <img src="<?php echo URL; ?>application/public/img/user-management.png" alt="Gestione utenti" width="130" class="rounded mx-auto mt-4 d-block ml-lg-5">
                <div class="mask gradient-custom"></div>
                </div>
                <!-- End -->
            </li>
            </a>
            <!-- End -->

            <!-- list group item-->
            <a class="text-decoration-none rounded mb-3" href="<?php echo URL; ?>services">
            <li class="list-group-item">
                <!-- Custom content-->
                <div class="media align-items-lg-center py-1">
                <div class="media-body">
                    <h4 class="mt-0 font-weight-bold mb-2">Gestione servizi</h4>
                    <p class="font-italic text-muted mb-0 small">Aggiungi, modiaddUser.phpfica, elimina i servizi.</p>
                </div>
                <img src="<?php echo URL; ?>application/public/img/admin-management.jpg" alt="Gestione amministratori" width="130" class="rounded mx-auto mt-4 d-block ml-lg-5">
                <div class="mask gradient-custom"></div>
                </div>
                <!-- End -->
            </li>
            </a>
            <!-- End -->
        </div>
    </div>
    <br><br><br><br><br><br><br>
</div>