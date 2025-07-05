<div class="head_menu_container">

    <!-- HEADER -->

    <header class="main-header" id="stickyHeader">
        <!-- Start::main-brand-header -->
        <div class="main-brand-header">
            <div class="container brand-header-container">
                <div class="d-flex align-items-center">
                    <!-- Start::header-element -->
                    <div class="header-element me-1">
                        <!-- Start::header-link -->
                        <a href="javascript:void(0);" class="sidemenu-toggle1 header-link" data-bs-toggle="sidebar">
                            <span class="open-toggle">
                                <i class="bi bi-text-indent-left header-link-icon"></i>
                            </span>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->
                    <a href="<?= base_url('member'); ?>" class="brand-main">
                        <img style="width: 30vh; margin-left: 10px; height: auto;"
                            src="<?= base_url('assets/') ?>images/brand/branding-logo.png" alt="img"
                            class="desktop-logo logo-dark">
                    </a>

                    <ul class="categories-dropdowns">
                        <li class="category-dropdown px-2 py-3">
                        </li>
                    </ul>
                </div>
                <ul class="nav list-unstyled align-items-center">
                    <li class="d-flex align-items-center position-relative me-md-4 me-2">
                        <span class="avatar bg-white-1 border rounded-circle tx-15 border-white-2 me-2">
                            <i style="color: #FFF;" class="fa-regular fa-trash-can"></i>
                        </span>
                        <div class="d-none d-md-block">
                            <a class="nav-link tx-15 p-0">Total Sampah</a>
                            <a class="mb-0 nav-link p-0 tx-13 op-8 lh-sm"><?= $user['total_sampah']; ?> buah</a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center position-relative me-md-4 me-2">
                        <span class="avatar bg-white-1 border rounded-circle tx-15 border-white-2 me-2">
                            <i class="bi bi-coin text-white"></i>
                        </span>
                        <div class="d-none d-md-block">
                            <a class="nav-link tx-15 p-0">Saldo</a>
                            <a class="mb-0 nav-link p-0 tx-13 op-8 lh-sm">
                                Rp. <?= number_format($user['koin'], 0, ',', '.'); ?>
                            </a>
                        </div>
                    </li>
                    <li class="d-flex align-items-center position-relative">
                        <img style="width: 43px; height: auto;"
                            src="<?= base_url('assets/images/user/profile/') . $user['photo']; ?>" alt="user"
                            class="avatar-img rounded-circle">
                    </li>
                </ul>
            </div>
        </div>
        <!-- End::main-brand-header -->
    </header> <!-- END HEADER -->

    <!-- SIDEBAR -->

    <div class="sticky">
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar" id="sidebar">

            <div class="app-toggle-header">
                <div class="header-element">
                    <!-- Start::header-link -->
                    <a href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
                        <span class="close-toggle">
                            <i class="bi bi-x header-link-icon"></i>
                        </span>
                    </a>
                    <!-- End::header-link -->
                </div>
                <!-- End::header-element -->
                <a href="<?= base_url('member'); ?>" class="brand-main">
                    <img src="<?= base_url('assets/') ?>images/brand/logo-white.png" alt="img"
                        class="desktop-logo logo-dark">
                </a>
            </div>

            <!-- Start::main-sidebar -->
            <div class="main-sidebar container" id="sidebar-scroll">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills sub-open">
                    <ul class="main-menu">

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="<?= base_url('member'); ?>" class="side-menu__item">
                                <span class="side-menu__label">Beranda</span>
                                <i class="fe fe-chevron-down side-menu__angle"></i>
                            </a>
                            <ul>
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="<?= base_url('member/about'); ?>" class="side-menu__item">
                                <span class="side-menu__label">Tentang Kami</span>
                                <i class="fe fe-chevron-down side-menu__angle"></i>

                            </a>
                            <ul>
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <!-- <li class="slide has-sub">
                            <a href="<?= base_url('member/about#faq'); ?>" class="side-menu__item">
                                <span class="side-menu__label">FAQ</span>
                                <i class="fe fe-chevron-down side-menu__angle"></i>
                            </a>
                            <ul>
                            </ul>
                        </li> -->
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="<?= base_url('member/profil'); ?>" class="side-menu__item">
                                <span class="side-menu__label">Profil Saya</span>
                                <i class="fe fe-chevron-down side-menu__angle"></i>
                            </a>
                            <ul>
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="<?= base_url('member/coupon'); ?>" class="side-menu__item">
                                <span class="side-menu__label">Kupon</span>
                                <i class="fe fe-chevron-down side-menu__angle"></i>
                            </a>
                            <ul>
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide has-sub">
                            <a href="<?= base_url('member/histori'); ?>" class="side-menu__item">
                                <span class="side-menu__label">Histori</span>
                                <i class="fe fe-chevron-down side-menu__angle"></i>
                            </a>
                            <ul>
                            </ul>
                        </li>
                        <!-- End::slide -->

                    </ul>

                    <div class="d-xl-flex d-lg-none d-grid gap-2 text-center" style="margin: 0px 10px 0px 10px;">
                        <a id="userGreet"
                            style="color: #FFF; margin-right: 5px; pointer-events: none; cursor: default; font-size: 15px; font-weight: 400"
                            class="btn">
                            <span id="pesanSelamat"></span> <?= $user['nama']; ?>
                        </a>
                        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-danger min-w-fit-content">
                            Keluar
                        </a>
                    </div>

                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->
    </div>
    <!-- END SIDEBAR -->
</div>