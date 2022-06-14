<aside class="main-sidebar sidebar-dark-primary elevation-4">
    

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Стартовая страница',
                        'icon' => 'tachometer-alt',
                        // 'badge' => '<span class="right badge badge-info">2</span>',
                        'url' => ['/admin/site/index']
                    ],
                    ['label' => 'Допущенные проекты', 'icon' => 'th', 'url' => ['/admin/admin/index'] ],
                    ['label' => 'Ожидают модерации', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info', 'url' => ['/admin/admin/modering'] ],
                    ['label' => 'Требуются исправления', 'iconClass' => 'nav-icon far fa-circle text-warning', 'url' => ['/admin/admin/fixing']],
                    ['label' => 'Заблокированные проекты', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger', 'url' => ['/admin/admin/ban']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>