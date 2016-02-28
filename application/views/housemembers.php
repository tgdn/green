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
                                <li>
                                    <div>
                                        <span class="house-members-list_name">
                                            <?php echo (int)$member['id'] == (int)$user->pk ? 'You' : Utils::escape($member['full_name']) ?>
                                        </span>
                                        <small class="house-members-list_email text-muted">
                                            <?php echo Utils::escape($member['email']) ?>
                                        </small>
                                        <button class="btn btn-xs btn-t-red-outline house-members-list_del-btn">
                                            <?php echo (int)$member['id'] == (int)$user->pk ? 'leave' : 'remove' ?>
                                        </button>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                            </ul>

                            <div class="text-center">
                                <a class="btn btn-t-plain" href="<?php echo Utils::url('h/create') ?>">
                                    Add housemates
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-4 col-lg-offset-0 col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-inline footer-list">
                            <li>CS139 - University of Warwick</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
</body>
</html>
