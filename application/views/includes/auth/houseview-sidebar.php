<?php
global $user;

if (isset($this) && isset($this->context['nav'])) {
    $class = $this->context['nav'];
} else {
    $class = null;
}
?>
<div class="col-sm-4 col-lg-3">
    <div class="list-group">
        <li class="list-group-item">
            <h5><b><?php echo Utils::escape($this->house['name']) ?></b></h5>
        </li>
        <a href="<?php echo Utils::url('h/' . $this->house['id']) ?>" class="list-group-item">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Bills
        </a>
        <a href="<?php echo Utils::url('h/' . $this->house['id'] . '/members') ?>" class="list-group-item <?php echo $class == 'members' ? 'active' : '' ?>">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Members
        </a>
        <a href="<?php echo Utils::url('h/' . $this->house['id'] . '/notifications') ?>" class="list-group-item <?php echo $class == 'notif' ? 'active' : '' ?>">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Notifications
            <span class="badge floatnone"></span>
        </a>
        <a href="<?php echo Utils::url('h/' . $this->house['id'] . '/settings') ?>" class="list-group-item <?php echo $class == 'prefs' ? 'active' : '' ?>">
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
