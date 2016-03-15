<link rel="stylesheet" type="text/css" href="<?php echo Utils::static_file('css/darktooltip.min.css') ?>">
<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">
            <?php $this->get_include('auth/houseview-sidebar') ?>

            <div class="col-sm-8 col-md-8 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5>
                            Your notifications
                        </h5>

                        <div id="housenotifications-app" class="larger-font">
                            <?php
                            $notifcount = 0;
                            ?>
                            <ul class="list-unstyled house-notifications-list">
                            <?php while ($notif = $this->context['notifications']->fetchArray(SQLITE3_ASSOC)): ?>
                                <?php
                                $created_at = new DateTime($notif['created_at']);
                                $notifcount++;
                                ?>
                                <li data-id="<?php echo $notif['id'] ?>">
                                    <a href="">
                                        <h5><?php echo Utils::escape($notif['name']) ?></h5>
                                        <p><?php echo Utils::escape($notif['message']) ?></p>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                            </ul>
                            <?php if ($notifcount == 0): ?>
                                <h3 class="text-center text-muted">No notifications</h3>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->get_include('auth/footer') ?>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
<script src="<?php echo Utils::static_file('js/vendor/bootstrap-confirmation-t.js') ?>" type="text/javascript"></script>
<script src="<?php echo Utils::static_file('js/dashboard.js') ?>" type="text/javascript"></script>
</body>
</html>
