<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">

            <div class="center-block col-sm-7 col-md-6 col-lg-5">
                <h3 class="text-right">
                    Dashboard&nbsp;
                    <i class="icon ion-ios-drag"></i>
                </h3>
                <div class="panel panel-default">
                    <div class="panel-body col-sm-10 col-sm-offset-1">
                        <h3 class="text-center">
                            Select a house
                        </h3>
                        <p class="subtitle-p text-muted text-left">
                            From here you select a house to manage or decide to
                            create a new one for your household.
                        </p>

                        <div id="houseview-app" class="larger-font">
                            <?php $housecount = 0 ?>
                            <ul class="list-unstyled dashboard-house-list">
                            <?php while ($house = $this->context['houses']->fetchArray(SQLITE3_ASSOC)): ?>
                                <?php $housecount++ ?>
                                <li>
                                    <a href="<?php echo Utils::url('h/' . $house['id']) ?>"><?php echo Utils::escape($house['name']) ?></a>
                                </li>
                            <?php endwhile; ?>
                            </ul>

                            <?php if ($housecount == 0): ?>
                            <p class="lead text-center text-muted">You aren't part of any house</p>
                            <?php endif ?>

                            <hr>

                            <div class="text-center">
                                <a class="btn btn-t-contrast" href="<?php echo Utils::url('h/create') ?>">
                                    Create a new one
                                </a>
                                <br>
                                <small>or</small>
                                <br>
                                <a class="btn btn-t-plain" href="<?php echo Utils::url('h/join') ?>">
                                    Join one
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>

        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
</body>
</html>
