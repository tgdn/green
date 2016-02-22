<title><?php echo $this->title ?></title>
</head>
<body>

<?php
if ($user->is_authenticated()):
    $this->get_include('navbar-auth');
else:
?>

<div class="container">
    <div class="row">
        <div class="center-block col-sm-6 col-md-5 col-lg-4">
            <p class="brand home-brand lead text-center">
                Green
            </p>
        </div>
    </div>
</div>

<?php $this->get_include('navbar'); endif; ?>

<div class="container">
    <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <h1><?php echo $this->message ?></h1>
                <?php if ($this->ex): ?>
                <p class="lead">
                    <?php echo $this->ex; ?>
                </p>
                <?php endif; ?>
            </div>
    </div>
</div>

<?php $this->get_include('scripts'); ?>
</body>
</html>
