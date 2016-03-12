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
                            Members
                        </h5>

                        <div id="houseview-app" class="larger-font">

                            <ul class="list-unstyled house-members-list">
                            <?php while ($member = $this->context['members']->fetchArray(SQLITE3_ASSOC)): ?>
                                <?php $is_you = (int)$member['id'] == (int)$user->pk ? true : false; ?>
                                <li data-id="<?php echo $member['id'] ?>">
                                    <div>
                                        <span class="house-members-list_name">
                                            <?php echo $is_you ? 'You' : Utils::escape($member['full_name']) ?>
                                        </span>
                                        <small class="house-members-list_email text-muted">
                                            <?php echo Utils::escape($member['email']) ?>
                                        </small>
                                        <?php if ($this->context['members_count'] > 1): ?>
                                        <a href="<?php echo Utils::url('h/' . $this->house['id'] . '/members/' . $member['id'] . '/remove') ?>"
                                            data-action="remove-from-house"
                                            title="<?php echo $is_you ? 'Leave ' . Utils::escape($this->house['name']) . '?' : 'Remove ' . Utils::escape($member['full_name']) . ' from ' . Utils::escape($this->house['name']) . '?' ?>"
                                            class="btn btn-xs btn-t-red-outline house-members-list_del-btn">
                                            <?php echo $is_you ? 'leave' : 'remove' ?>
                                        </a>
                                        <?php else: ?>
                                            <small class="text-right house-members-list_del-btn text-muted">
                                                There aren't any actions for you to take
                                                on yourself.
                                            </small>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                            </ul>

                            <div class="text-center">
                                <a class="btn btn-t-plain" href="<?php echo Utils::url('h/' . $this->house['id'] . '/members/add') ?>">
                                    Add housemates
                                </a>
                            </div>
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
