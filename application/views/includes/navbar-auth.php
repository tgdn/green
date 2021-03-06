<nav class="navbar navbar-default navbar-main navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand brand" tabindex="1" href="<?php echo Utils::url('dashboard') ?>">Green</a>
        </div>

        <?php
            if (isset($this) && isset($this->context['nav'])) {
                $class = $this->context['nav'];
            } else {
                $class = null;
            }
        ?>

        <div class="navbar-container" id="main-menu">
            <ul class="nav navbar-nav">
                <?php if (isset($this->house)): ?>
                <li class="active"><a tabindex="2" href="<?php echo Utils::url('h/' . $this->house['id'] . '/bills/create') ?>">New bill</a></li>
                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <!-- <li <?php /*echo $class == 'dashboard' ? 'class="active"' : ''*/ ?>><a href="<?php echo Utils::url('dashboard') ?>">Dashboard</a></li> -->
                <li <?php echo $class == 'account' ? 'class="active"' : '' ?>><a tabindex="3" href="<?php echo Utils::url('account') ?>">Account</a></li>
                <li><a tabindex="4" href="<?php echo Utils::url('logout') ?>">Log out</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
