</head>
<body style="background: linear-gradient(90deg, #5d80bb, #44006b 100%);">
<div>
<!--<div class="mask" style="background: linear-gradient(90deg, #26395a, #44006b 100%)"></div>-->
  <!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-light bg-white sticky-top">
  <!-- Container wrapper -->
  <div class="container-fluid ml-3">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="bi bi-list" style="font-size: 25px"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-lg-0" href="<?php echo URL; ?>home">
        <i class="bi bi-house-door-fill fa-lg" style="font-size: 30px; color:#26395a"></i>
      </a>
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" style="color:#26395a" href="<?php echo URL; ?>clients">Clienti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:#26395a" href="<?php echo URL; ?>products">Prodotti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:#26395a" href="<?php echo URL; ?>services">Servizi</a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
      <!-- Icon -->
      <a class="link-secondary me-3" href="<?php echo URL; ?>login">
        <i class="bi bi-box-arrow-right" style="font-size: 27px; color:#26395a"></i>
      </a>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</div>