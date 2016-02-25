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
                        <div id="housecreate-app" class="larger-font">
                            <form method="post" action="">
                                <div class="form-group form-group-lg">
                                    <p class="help-block text-lg">
                                        Name your house after the group that will be living together.
                                    </p>
                                    <p class="help-block text-lg">
                                        <b class="text-dark">Living in a flat or a house?</b> Try using a name that represents who you are.
                                    </p>
                                    <label for="name-id">House name <small class="text-muted">(you can change this later)</small></label>
                                    <input type="text" name="name" class="form-control" id="name-id" placeholder="Ex. Flat 16, Home, Summer camp ...">
                                </div>

                                <h4 class="subtitle">Add your housemates</h4>

                                <div class="form-group form-group-lg">
                                    <p class="help-block text-lg">
                                        Your house might feel a little lonely all by yourself.
                                    </p>
                                    <label>Email address <small class="text-muted">(you can add more later or leave it blank)</small></label>
                                </div>
                                <div class="form-group form-group-lg">
                                    <input type="text" name="email1" class="form-control" placeholder="name@domain.com">
                                </div>
                                <div class="form-group form-group-lg">
                                    <input type="text" name="email2" class="form-control" placeholder="name@domain.com">
                                </div>
                                <div class="form-group form-group-lg">
                                    <input type="text" name="email3" class="form-control" placeholder="name@domain.com">
                                </div>

                                <?php foreach ($this->form_errors as $error) { ?>
                                <div class="form-group has-error">
                                    <span class="help-block"><?php echo $error ?></span>
                                </div>
                                <?php } ?>

                                <div class="form-group text-center center-block">
                                    <input type="submit" value="Create" class="btn btn-lg btn-t-contrast">
                                    <a href="<?php echo Utils::url('dashboard') ?>" class="btn btn-lg btn-t-plain">Cancel</a>
                                </div>
                            </form>
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
