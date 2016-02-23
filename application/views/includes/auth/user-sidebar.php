<?php global $user ?>
<div class="col-sm-4 col-lg-3">
    <div class="list-group">
        <li class="list-group-item">
            <h5><b><?php echo $user->full_name; ?></b></h5>
        </li>
        <a href="<?php echo Utils::url('dashboard') ?>"" class="list-group-item">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Your houses
        </a>
        <a href="#" class="list-group-item">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Notifications
            <span class="badge floatnone"></span>
        </a>
        <a href="<?php echo Utils::url('preferences') ?>" class="list-group-item">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Preferences
        </a>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <h5>
                People
            </h5>
            <ul class="list-unstyled">
                <li class="empty-list">
                    <em>No people yet</em>
                </li>
            </ul>
        </div>
    </div>
</div>
