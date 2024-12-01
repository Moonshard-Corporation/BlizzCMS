<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $template['title'] ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $template['assets'] . 'img/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= $template['assets'] . 'css/uikit.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'] . 'css/tail.select.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'] . 'css/default.css' ?>">
    <script src="<?= $template['assets'] . 'js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'] . 'js/uikit-icons.min.js' ?>"></script>
    <script src="<?= $template['assets'] . 'js/tail.select.min.js' ?>"></script>
    <script src="<?= $template['assets'] . 'js/purecounter.min.js' ?>"></script>
    <script src="<?= $template['assets'] . 'fontawesome/js/all.min.js' ?>" defer></script>
    <?= $template['head_tags'] ?>
</head>

<body>
    <nav class="uk-navbar-container uk-navbar-transparent">
        <div class="uk-container">
            <div uk-navbar>
                <div class="uk-navbar-left">
                    <a href="<?= site_url() ?>" class="uk-navbar-item uk-logo">
                        <?= configItem('app_name') ?>
                    </a>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#">
                                <i class="fa-solid fa-language"></i>
                                <span class="uk-text-uppercase">
                                    <?= $multilanguage->currentLanguage('locale') ?>
                                </span>
                            </a>
                            <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <?php foreach ($multilanguage->languages() as $language) : ?>
                                        <li>
                                            <a href="<?= site_url('lang/' . $language['locale']) ?>">
                                                <?= $language['name'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </li>
                        <?php /*
                        <?php if (! isLoggedIn()): ?>
                            <li class="uk-visible@s">
                                <a href="<?= site_url('login') ?>"><i class="fa-solid fa-right-to-bracket"></i> <?= lang('login') ?></a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="#">
                                <img class="uk-border-circle" src="<?= user_avatar() ?>" width="32" height="32" alt="<?= lang('avatar') ?>">
                                <span class="uk-text-middle"><span uk-icon="icon: triangle-down"></span></span>
                                </a>
                                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="<?= is_route_active('user') ? 'uk-active' : '' ?>">
                                    <a href="<?= site_url('user') ?>"><span class="bc-li-icon"><i class="fa-solid fa-circle-user"></i></span><?= lang('user_panel') ?></a>
                                    </li>
                                    <?php if (has_permission('view.admin', 'admin')): ?>
                                    <li>
                                    <a href="<?= site_url('admin') ?>"><span class="bc-li-icon"><i class="fa-solid fa-gear"></i></span><?= lang('admin_panel') ?></a>
                                    </li>
                                    <?php endif ?>
                                    <li>
                                    <a href="<?= site_url('logout') ?>"><span class="bc-li-icon"><i class="fa-solid fa-right-from-bracket"></i></span><?= lang('logout') ?></a>
                                    </li>
                                </ul>
                                </div>
                            </li>
                        <?php if (isModuleInstalled('store')) : ?>
                            <li>
                                <a href="#">
                                <i class="fa-solid fa-cart-shopping"></i> <span class="uk-badge"><?= $this->cart->total_items() ?></span>
                                </a>
                                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                                <div class="cart-container">
                                    <?php if ($this->cart->total_items()): ?>
                                    <p class="uk-text-center uk-margin-small"><?= lang_vars('cart_have_products', [$this->cart->total_items()]) ?></p>
                                    <a href="<?= site_url('store/cart') ?>" class="uk-button uk-button-default uk-button-small uk-width-1-1"><?= lang('go_cart') ?></a>
                                    <?php else: ?>
                                    <p class="uk-text-center uk-margin-remove"><?= lang('cart_is_empty') ?></p>
                                    <?php endif ?>
                                </div>
                                </div>
                            </li>
                        <?php endif ?>
                        <?php endif ?>
                        */ ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <?= $template['body'] ?>
    <footer class="uk-section uk-section-xsmall bc-footer-section">
        <div class="uk-container">
            <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-expand@s">
                    <p class="uk-text-small uk-text-center uk-text-left@s uk-margin-remove"><i class="fa-regular fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold"><?= configItem('app_name') ?></span> - <?= lang('General.rights_reserved') ?></p>
                    <p class="uk-text-small uk-text-center uk-text-left@s uk-margin-remove"><i class="fa-solid fa-bolt fa-shake"></i> <?= lang('General.powered_by') ?> <a target="_blank" class="uk-text-bold" href="https://wow-cms.com">BlizzCMS</a></p>
                </div>
                <div class="uk-width-auto@s">
                    <div class="uk-flex uk-flex-center uk-margin">
                        <?php if (!empty(configItem('social_facebook'))) : ?>
                            <a target="_blank" href="https://facebook.com/groups/<?= configItem('social_facebook') ?>" class="uk-icon-button"><i class="fa-brands fa-facebook-f"></i></a>
                        <?php endif ?>
                        <?php if (!empty(configItem('social_twitch'))) : ?>
                            <a target="_blank" href="https://twitch.tv/<?= configItem('social_twitch') ?>" class="uk-icon-button uk-margin-small-left"><i class="fa-brands fa-twitch"></i></a>
                        <?php endif ?>
                        <?php if (!empty(configItem('social_reddit'))) : ?>
                            <a target="_blank" href="https://reddit.com/r/<?= configItem('social_reddit') ?>" class="uk-icon-button uk-margin-small-left"><i class="fa-brands fa-reddit-alien"></i></a>
                        <?php endif ?>
                        <?php if (!empty(configItem('social_x'))) : ?>
                            <a target="_blank" href="https://x.com/@<?= configItem('social_x') ?>" class="uk-icon-button uk-margin-small-left"><i class="fa-brands fa-x-twitter"></i></a>
                        <?php endif ?>
                        <?php if (!empty(configItem('social_youtube'))) : ?>
                            <a target="_blank" href="https://youtube.com/@<?= configItem('social_youtube') ?>" class="uk-icon-button uk-margin-small-left"><i class="fa-brands fa-youtube"></i></a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div id="offcanvas_nav" uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar">
            <div class="uk-panel">
                <ul class="uk-nav-default" uk-nav>
                    <?php /*
                    <?php if (!is_logged_in()) : ?>
                        <li>
                            <a href="<?= site_url('login') ?>"><span class="bc-li-icon"><i class="fa-solid fa-right-to-bracket"></i></span><?= lang('login') ?></a>
                        </li>
                    <?php endif ?>
                    <?php foreach ($this->menu_model->display() as $item) : ?>
                        <?php if ($item->type === ITEM_DROPDOWN) : ?>
                            <li class="uk-parent">
                                <a href="#">
                                    <?= $item->icon !== '' ? '<span class="bc-li-icon"><i class="' . $item->icon . '"></i></span>' : '' ?>
                                    <?= $item->name ?> <span uk-nav-parent-icon></span>
                                </a>
                                <ul class="uk-nav-sub">
                                    <?php foreach ($item->childs as $subitem) : ?>
                                        <li class="<?= is_route_active($subitem->url) ? 'uk-active' : '' ?>">
                                            <a target="<?= $subitem->target ?>" href="<?= $subitem->url ?>">
                                                <?= $subitem->icon !== '' ? '<span class="bc-li-icon"><i class="' . $subitem->icon . '"></i></span>' : '' ?>
                                                <?= $subitem->name ?>
                                            </a>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            </li>
                        <?php elseif ($item->type === ITEM_LINK) : ?>
                            <li class="<?= is_route_active($item->url) ? 'uk-active' : '' ?>">
                                <a target="<?= $item->target ?>" href="<?= $item->url ?>">
                                    <?= $item->icon !== '' ? '<span class="bc-li-icon"><i class="' . $item->icon . '"></i></span>' : '' ?>
                                    <?= $item->name ?>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endforeach ?>
                    */ ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="<?= $template['assets'] . 'js/main.js' ?>"></script>
    <?= $template['body_tags'] ?>
</body>

</html>