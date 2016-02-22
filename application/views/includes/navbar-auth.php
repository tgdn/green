<nav class="navbar navbar-default navbar-main navbar-static-top">
    <div class="container-fluid">

        <?php
            if (isset($this) && isset($this->context['nav'])) {
                $class = $this->context['nav'];
            } else {
                $class = null;
            }
        ?>

        <div class="navbar-container" id="main-menu">
            <ul class="nav navbar-nav">
                <li <?php echo $class == 'dashboard' ? 'class="active"' : '' ?>><a href="<?php echo Utils::url('dashboard') ?>">Dashboard</a></li>
                <li><a href="<?php echo Utils::url('logout') ?>">Log out</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
