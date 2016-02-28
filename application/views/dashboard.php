<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">

            <div class="center-block col-sm-6 col-md-5 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body col-sm-10 col-sm-offset-1">
                        <h3 class="text-center">
                            Select a house
                        </h3>
                        <p class="text-muted text-left">
                            From here you select a house to manage or decide to
                            create a new one for your household.
                        </p>

                        <div id="houseview-app" class="larger-font">

                            <ul class="list-unstyled dashboard-house-list">
                            <?php while ($house = $this->context['houses']->fetchArray(SQLITE3_ASSOC)): ?>
                                <li>
                                    <a href="<?php echo Utils::url('h/' . $house['id']) ?>"><?php echo Utils::escape($house['name']) ?></a>
                                </li>
                            <?php endwhile; ?>
                            </ul>

                            <div class="text-center">
                                <a class="btn btn-t-plain" href="<?php echo Utils::url('h/create') ?>">
                                    Or create a new one
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
