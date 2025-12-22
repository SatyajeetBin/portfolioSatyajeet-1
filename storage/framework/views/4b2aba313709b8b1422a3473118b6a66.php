<style>
    .filter{
        justify-content: space-evenly;
        margin-bottom: 8px;
    }
    .filter button{
        font-size: x-small;
    }
    html {
        scroll-behavior: smooth;
    }
</style>

<nav class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="mdi mdi-menu mdi-24px"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <?php if(Route::current()->getName() == 'dashboard'): ?>
            <!-- Welcome Text -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0 mt-4">
                    <h3>Welcome <?php echo e(auth()->user()->first_name); ?> !</h3>
                </div>
            </div>
            <!-- /Welcome Text -->
        <?php endif; ?>
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2 me-xl-1">
                <a class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline mdi-24px"></i>
                    <span
                        class="position-absolute top-0 start-50 translate-middle-y badge badge-dot bg-danger mt-2 border unread-notification-count">
                        
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0" id="notificationDropdown" style="height: 538px">
                    <li class="dropdown-menu-header border-bottom py-50">
                        <div class="dropdown-header d-flex align-items-center py-2">
                            <h6 class="mb-0 me-auto">Notifications</h6>
                            <div class="d-flex align-items-center">
                                <span class="badge rounded-pill bg-label-primary fs-xsmall me-2" id="unread-count">0
                                    New</span>
                                <button type="button" aria-label="Mark all as read" data-bs-toggle="tooltip" data-bs-original-title="Mark all as read" id="markAllRead"
                                    class="btn btn-text-secondary rounded-pill btn-icon dropdown-notifications-all">
                                    <i class="ri-mail-open-line text-heading ri-20px"></i>
                                </button>
                            </div>
                        </div>
                        <form id="filter-form">
                            <div class="form-floating w-auto d-flex filter">
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="fetchNotifications('all')">
                                    All
                                  </button>
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="fetchNotifications('read')">
                                    Read
                                  </button>
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="fetchNotifications('unread')">
                                    Unread
                                  </button>
                                
                            </div>
                        </form>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                        <ul class="list-group list-group-flush" id="notificationList"></ul>
                    </li>
                </ul>
            </li>
        </ul>

        <!--/ Notification -->
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown profile">
            <a class="nav-link dropdown-toggle hide-arrow pr" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar">
                    <img src="<?php echo e(asset('upload/user-profile/' . Auth::user()->picture)); ?>" alt
                        class="w-px-40 h-px-40 rounded-circle" />
                    

                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar ">
                                    <img src="<?php echo e(asset('upload/user-profile/' . Auth::user()->picture)); ?>"
                                        class="w-px-40 h-auto rounded-circle" />
                                    
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <span class="fw-medium d-block"><?php echo e(Auth::user()->first_name); ?></span>
                                <small
                                    class="text-muted"><?php echo e(Auth::user()->role ? Auth::user()->role->name : ''); ?></small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="mdi mdi-account-outline me-2"></i>
                        <span class="align-middle">My Profile</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="mdi mdi-key-outline me-2"></i>
                        <span class="align-middle">Change Password</span>
                    </a>
                </li>
                
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout me-2"></i>
                        <span class="align-middle">Log Out</span>

                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                            <?php echo csrf_field(); ?>
                        </form>
                    </a>

                    
                </li>
            </ul>
        </li>
        <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input autocomplete="off" type="text" class="form-control search-input container-xxl border-0"
            placeholder="Search..." aria-label="Search..." />
        <i class="mdi mdi-close search-toggler cursor-pointer"></i>
    </div>
</nav>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php /**PATH C:\Users\binstellar\OneDrive\Desktop\portfolioSatyajeet\resources\views/layouts/header.blade.php ENDPATH**/ ?>