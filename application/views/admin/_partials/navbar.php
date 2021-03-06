<nav class="navbar navbar-expand navbar-dark bg-success static-top">

    <a class="navbar-brand mr-1" href="<?php echo site_url('admin') ?>">POS PT RPN</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
       
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

        <li class="nav " onload="setInterval('displayServerTime()', 1000);">
            <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div id="clock"><?php print date('H:i:s'); ?></div>
            </a>
        </li>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <?php 
                $tgl = date('d / M / y');
                echo $tgl;
                ?>
            </a>
        </li>

        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <?php 
                $user = $this->session->userdata('username');
                ?>
                <i class="fas fa-user-circle fa-fw"></i> <?php  echo $user; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo site_url('otentikasi/logout') ?>" d>Logout</a>
            </div>
        </li>
    </ul>

</nav>