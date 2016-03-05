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
        <a tabindex="4" href="<?php echo Utils::url('h/' . $this->house['id'] . '/bills') ?>" class="list-group-item <?php echo $class == 'bills' ? 'active' : '' ?>">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Bills
        </a>
        <a tabindex="5" href="<?php echo Utils::url('h/' . $this->house['id'] . '/members') ?>" class="list-group-item <?php echo $class == 'members' ? 'active' : '' ?>">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Members
        </a>
        <a tabindex="6" href="<?php echo Utils::url('h/' . $this->house['id'] . '/notifications') ?>" class="list-group-item <?php echo $class == 'notif' ? 'active' : '' ?>">
            <span class="pull-right"><i class="icon ion-ios-arrow-right"></i></span>
            Notifications
            <span class="badge floatnone"></span>
        </a>
        <a tabindex="7" href="<?php echo Utils::url('h/' . $this->house['id'] . '/settings') ?>" class="list-group-item <?php echo $class == 'prefs' ? 'active' : '' ?>">
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
                <?php while ($member = $this->members10->fetchArray(SQLITE3_ASSOC)): ?>
                <li>
                    <?php echo Utils::escape($member['full_name']) ?>
                </li>
                <?php endwhile; ?>
                <!-- <li class="empty-list">
                    <em>No people yet</em>
                </li> -->
            </ul>
        </div>
    </div>
</div>
