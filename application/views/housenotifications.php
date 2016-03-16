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
                        <h5 class="pull-left">
                            Your notifications
                        </h5>
                        <a href="#" class="pull-right">Mark all as read</a>

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
                                    <div class="notif-content">
                                        <a href="">
                                            <?php echo Utils::escape($notif['message']) ?>
                                        </a>
                                        <span class="notif-date">
                                            <i class="icon ion-ios-calendar-outline"></i>
                                            <?php echo $created_at->format('F j') ?>
                                            at
                                            <?php echo $created_at->format('H:i') ?>
                                        </span>
                                    </div>
                                    <div class="notif-actions">
                                        <label>
                                            <input type="checkbox" name="userselect" class="sr-only" value="">
                                            <span>
                                                <i class="icon unchecked ion-ios-circle-filled" data-toggle="tooltip" data-placement="top" title="Mark as read"></i>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="clear"></div>
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

<script type="text/javascript">
$(function () {
    $('[data-toggle="tooltip"]').tooltip({
        html: true
    })
});
</script>
</body>
</html>
