<title><?php echo $this->title ?></title>
</head>
<body>

<?php $this->get_include('navbar-auth') ?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-12">

            <div class="center-block col-sm-8 col-md-8 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-body col-sm-10 col-sm-offset-1">
                        <h3 class="text-center">
                            Create a new house
                        </h3>
                        <div id="houseview-app" class="larger-font">

                        </div>
                    </div>
                    <div class="clear"></div>
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
