<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="dark">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <!-- User Info & Collapse -->

            <!-- End User Info & Collapse -->

            <!-- Dynamic Menu from Database -->
            <ul class="nav nav-primary">
                <!-- QUERY MENU -->
                <li class="nav-section">
                    <?php

                    $role_id = $this->session->userdata('role_id');

                    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                                  FROM `user_menu` JOIN `user_access_menu`
                                  ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                                  WHERE `user_access_menu`.`role_id` = $role_id
                                  ORDER BY `user_access_menu`.`menu_id` ASC
                                 ";
                    $menu = $this->db->query($queryMenu)->result_array();

                    ?>

                    <!-- LOOPING MENU -->
                    <?php foreach ($menu as $m) : ?>
                    <!-- <h5 class="text-section">
                        <?= $m['menu']; ?>
                    </h5> -->

                    <?php
                        $menuId = $m['id'];

                        $querySubMenu = "SELECT *
                                         FROM   `user_sub_menu`
                                         WHERE  `menu_id` = $menuId
                                         AND    `is_active` = 1
                                       ";
                        $subMenu = $this->db->query($querySubMenu)->result_array();
                        ?>

                    <hr class="sidebar-divider" style="background: #292F42; width: 92%; height: 1px">

                    <?php foreach ($subMenu as $sm) : ?>
                    <?php if ($judul == $sm['id']) : ?>
                <li class="nav-item">
                    <?php else : ?>
                <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <p> <?= $sm['title']; ?> </p>
                    </a>
                </li>

                <?php endforeach ?>

                <?php endforeach; ?>

                <!-- <li class="nav-item active">
                <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                    <i class="fas fa-home"></i>
                    <p>Dashboard</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse" id="dashboard">
                    <ul class="nav nav-collapse">
                        <li>
                            <a href="../demo1/index.html">
                                <span class="sub-item">Dashboard 1</span>
                            </a>
                        </li>
                        <li>
                            <a href="../demo2/index.html">
                                <span class="sub-item">Dashboard 2</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->

                <!-- Pengaturan User -->
                <!-- <a data-toggle="collapse" href="#base">
                        <i class="fas fa-user"></i>
                        <p>Pengaturan User</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= base_url('admin/my_profile') ?>">
                                    <span class="sub-item">Profil Saya</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('admin/my_profile') ?>">
                                    <span class="sub-item">Ubah Password</span>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                </li>
                <!-- Tambahan menu lainnya di sini -->
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->