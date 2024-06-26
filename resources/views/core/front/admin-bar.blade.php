<?php
    $user = Auth::user();
    $loran_ico = asset('public/includes/images/loran-icon-white.svg');
    $url_dashboard = route('my-admin');
    $url_home = route('home');
    $route_dashboard = Request::segment(1);
    $sitename = Core::getOption('sitename');

    if (isset($_GET['preview']) != 'theme') :
?>
<div id="admin-bar" class="admin-bar user-id-<?php echo $user->id; ?>" data-show="true">
    <ul class="left-nav">
        <li class="loran-icon-link">
            <a href="https://loranengine.org/" target="_blank">
                <img src="<?php echo $loran_ico; ?>" alt="">
            </a>
        </li>
        <?php if ( $route_dashboard == 'cs-admin' ) : ?>
            <li>
                <a href="<?php echo $url_home; ?>"><i class="icofont-home"></i><?php echo $sitename; ?></a>
            </li>
        <?php else : ?>
            <li>
                <a href="<?php echo $url_dashboard; ?>"><i class="icofont-speed-meter"></i><?php echo __('Dashboard'); ?></a>
            </li>
        <?php endif; ?>
        <?php if(Auth::user()->role == 0 || Auth::user()->role == 1) : ?>
            <li>
                <a href="<?php echo route('my-admin-themes'); ?>">
                    <i class="icofont-ui-theme"></i>
                    <?php echo __('Themes'); ?>
                </a>
            </li>
            <li>
                <a href="<?php echo route('my-admin-posts'); ?>">
                    <i class="icofont-ui-add smallicon"></i>
                    <?php echo __('Add'); ?>
                </a>
                <ul class="submenu">
                    <li><a href="<?php echo route('my-admin-create-post'); ?>"><?php echo __('Post'); ?></a></li>
                    <li><a href="#"><?php echo __('Page'); ?></a></li>
                    <li><a href="#"><?php echo __('Comment'); ?></a></li>
                    <li><a href="#"><?php echo __('User'); ?></a></li>
                </ul>
            </li>
        <?php endif; ?>
        <?php if (Core::serverAPI()['version'] > Core::App()['ver']) : ?>
            <li class="updates_available"><a href="<?php echo route('my-admin-core-update'); ?>"><i class="icofont-download-alt"></i><?php echo __('Updates'); ?></a></li>
        <?php endif; ?>
    </ul>
    <ul class="right-nav">
        <li class="user-link">
            <a href="#">
                <img src="<?php echo asset('public/includes/images/usericon.svg'); ?>" alt="<?php echo $user->name; ?>">
                <?php echo __('Hello, ' . $user->name); ?>
            </a>
            <ul class="submenu">
                <li>
                    <a href="#"><?php echo __('Edit Account'); ?></a>
                </li>
                <li>
                    <a href="<?php echo route('logout'); ?>"><?php echo __('Logout'); ?></a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<?php endif; ?>
