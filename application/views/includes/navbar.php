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
                <li <?php echo $class == 'home' ? 'class="active"' : '' ?>><a href="<?php echo URL ?>">Log In</a></li>
                <li <?php echo $class == 'register' ? 'class="active"' : '' ?>><a href="<?php echo URL . 'register' ?>">Register</a></li>
            </ul>
        </div>
    </div>
</nav>
