<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">
            <?php $this->get_include('auth/user-sidebar') ?>
            
            <div class="col-sm-8 col-md-8 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h5>
                            Your houses
                        </h5>
                        <ul class="list-unstyled">
                            <li class="empty-list">
                                <p><em>No houses yet</em></p>
                                <button class="btn btn-md btn-t-plain">
                                    Create one
                                </button>
                            </li>
                        </ul>
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
        <!-- <div class="center-block col-sm-6 col-md-5 col-lg-4" id="public-app-main"> -->
        <!-- </div> -->
    </div>
</div>

<?php $this->get_include('scripts'); ?>
</body>
</html>
