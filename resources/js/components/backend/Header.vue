<template>
    <div class="navbar-custom topnav-navbar">
        <div class="container-fluid detached-nav">
            <!-- Topbar Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <router-link :to="{ name: 'admin.dashboard' }" class="logo-light">
                    <span class="logo-lg">
                        <img
                            :src="$root.baseurl+'/admin/images/logo.png'"
                            alt="logo"
                            height="50"
                        />
                    </span>
                    <span class="logo-sm">
                        <img
                            :src="$root.baseurl+'/admin/images/logo-sm.png'"
                            alt="small logo"
                            height="22"
                        />
                    </span>
                </router-link>

                <!-- Logo Dark -->
                <router-link :to="{ name: 'admin.dashboard' }" class="logo-dark">
                    <span class="logo-lg">
                        <img
                            :src="$root.baseurl+'/admin/images/logo-dark.png'"
                            alt="dark logo"
                            height="50"
                        />
                    </span>
                    <span class="logo-sm">
                        <img
                            :src="$root.baseurl+'/admin/images/logo-dark-sm.png'"
                            alt="small logo"
                            height="22"
                        />
                    </span>
                </router-link>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-format-align-left"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button
                class="navbar-toggle"
                data-bs-toggle="collapse"
                data-bs-target="#topnav-menu-content"
            >
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <ul class="list-unstyled topbar-menu float-end mb-0">
                <li class="dropdown notification-list">
                    <a
                        class="nav-link dropdown-toggle arrow-none"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <i class="ri-notification-3-line noti-icon"></i>
                        <span class="noti-icon-badge"></span>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0"
                    >
                        <div
                            class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border"
                        >
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 font-16 fw-semibold">
                                        Notification
                                    </h6>
                                </div>
                                <div class="col-auto">
                                    <a
                                        href="javascript: void(0);"
                                        class="text-dark text-decoration-underline"
                                    >
                                        <small>Clear All</small>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div
                            class="px-3"
                            style="max-height: 300px;"
                            data-simplebar
                        >
                            <h5 class="text-muted font-13 fw-normal mt-2">
                                Today
                            </h5>
                            <!-- item-->

                            <a
                                href="javascript:void(0);"
                                class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2"
                            >
                                <div class="card-body">
                                    <span
                                        class="float-end noti-close-btn text-muted"
                                        ><i class="mdi mdi-close"></i
                                    ></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i
                                                    class="mdi mdi-comment-account-outline"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="flex-grow-1 text-truncate ms-2"
                                        >
                                            <h5
                                                class="noti-item-title fw-semibold font-14"
                                            >
                                                Datacorp
                                                <small
                                                    class="fw-normal text-muted ms-1"
                                                    >1 min ago</small
                                                >
                                            </h5>
                                            <small
                                                class="noti-item-subtitle text-muted"
                                                >Caleb Flakelar commented on
                                                Admin</small
                                            >
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a
                                href="javascript:void(0);"
                                class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2"
                            >
                                <div class="card-body">
                                    <span
                                        class="float-end noti-close-btn text-muted"
                                        ><i class="mdi mdi-close"></i
                                    ></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-info">
                                                <i
                                                    class="mdi mdi-account-plus"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="flex-grow-1 text-truncate ms-2"
                                        >
                                            <h5
                                                class="noti-item-title fw-semibold font-14"
                                            >
                                                Admin
                                                <small
                                                    class="fw-normal text-muted ms-1"
                                                    >1 hours ago</small
                                                >
                                            </h5>
                                            <small
                                                class="noti-item-subtitle text-muted"
                                                >New user registered</small
                                            >
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h5 class="text-muted font-13 fw-normal mt-0">
                                Yesterday
                            </h5>

                            <!-- item-->
                            <a
                                href="javascript:void(0);"
                                class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2"
                            >
                                <div class="card-body">
                                    <span
                                        class="float-end noti-close-btn text-muted"
                                        ><i class="mdi mdi-close"></i
                                    ></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <img
                                                    :src="$root.baseurl+'admin/images/users/avatar-2.jpg'"
                                                    class="img-fluid rounded-circle"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                        <div
                                            class="flex-grow-1 text-truncate ms-2"
                                        >
                                            <h5
                                                class="noti-item-title fw-semibold font-14"
                                            >
                                                Cristina Pride
                                                <small
                                                    class="fw-normal text-muted ms-1"
                                                    >1 day ago</small
                                                >
                                            </h5>
                                            <small
                                                class="noti-item-subtitle text-muted"
                                                >Hi, How are you? What about our
                                                next meeting</small
                                            >
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h5 class="text-muted font-13 fw-normal mt-0">
                                30 Dec 2021
                            </h5>

                            <!-- item-->
                            <a
                                href="javascript:void(0);"
                                class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2"
                            >
                                <div class="card-body">
                                    <span
                                        class="float-end noti-close-btn text-muted"
                                        ><i class="mdi mdi-close"></i
                                    ></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i
                                                    class="mdi mdi-comment-account-outline"
                                                ></i>
                                            </div>
                                        </div>
                                        <div
                                            class="flex-grow-1 text-truncate ms-2"
                                        >
                                            <h5
                                                class="noti-item-title fw-semibold font-14"
                                            >
                                                Datacorp
                                            </h5>
                                            <small
                                                class="noti-item-subtitle text-muted"
                                                >Caleb Flakelar commented on
                                                Admin</small
                                            >
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a
                                href="javascript:void(0);"
                                class="dropdown-item p-0 notify-item card read-noti shadow-none mb-2"
                            >
                                <div class="card-body">
                                    <span
                                        class="float-end noti-close-btn text-muted"
                                        ><i class="mdi mdi-close"></i
                                    ></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <img
                                                    :src="$root.baseurl+'/admin/images/users/avatar-4.jpg'"
                                                    class="img-fluid rounded-circle"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                        <div
                                            class="flex-grow-1 text-truncate ms-2"
                                        >
                                            <h5
                                                class="noti-item-title fw-semibold font-14"
                                            >
                                                Karen Robinson
                                            </h5>
                                            <small
                                                class="noti-item-subtitle text-muted"
                                                >Wow ! this admin looks good and
                                                awesome design</small
                                            >
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="text-center">
                                <i
                                    class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"
                                ></i>
                            </div>
                        </div>

                        <!-- All-->
                        <a
                            href="javascript:void(0);"
                            class="dropdown-item text-center text-primary notify-item border-top border-light py-2"
                        >
                            View All
                        </a>
                    </div>
                </li>
                <li class="notification-list d-none d-sm-inline-block">
                    <a
                        class="nav-link"
                        href="javascript:void(0)"
                        id="light-dark-mode"
                    >
                        <i class="ri-moon-line noti-icon"></i>
                    </a>
                </li>

                <li class="notification-list d-none d-md-inline-block">
                    <a class="nav-link" href="#" data-toggle="fullscreen">
                        <i class="ri-fullscreen-line noti-icon"></i>
                    </a>
                </li>

                <li class="dropdown notification-list">
                    <a
                        class="nav-link dropdown-toggle nav-user arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <span class="account-user-avatar">
                            <img
                                :src="profileImage ? profileImage : $root.userimage"
                                alt="user-image"
                                class="rounded-circle"
                            />
                        </span>
                        <span>
                            <span class="account-user-name">{{ logged_name}}</span>
                            <span class="account-position">{{ role_name }}</span>
                        </span>
                    </a>
                    <div
                        class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
                    >
                        <!-- item-->
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>
                        <!-- item-->
                        <router-link :to="{name:'admin.dashboard'}"
                                     class="dropdown-item notify-item"
                        >
                            <i class="mdi mdi-home me-1"></i>
                            <span>Dashboard</span>
                        </router-link>
                        <!-- item-->
                        <router-link  :to="{ name: 'admin.show', params: { id: logged_id } }"
                            href="javascript:void(0);"
                            class="dropdown-item notify-item"
                        >
                            <i class="mdi mdi-account-circle me-1"></i>
                            <span>My Account</span>
                        </router-link>

                        <!-- item-->
                        <router-link :to="{name:'siteSetting.index'}"
                            href="javascript:void(0);"
                            class="dropdown-item notify-item"
                        >
                            <i class="mdi mdi-account-edit me-1"></i>
                            <span>Settings</span>
                        </router-link>
                        <!-- item-->
                        <a
                            @click="Logout()"
                            href="javascript:void(0);"
                            class="dropdown-item notify-item"
                        >
                            <i class="mdi mdi-logout me-1"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            role_name: "",
            logged_id: "",
            logged_name: ""
        };
    },
    computed: {
        profileImage() {
            return this.$root.baseurl+'/admin/images/users/avatar-4.jpg';
        }
    },
    methods: {
        Logout() {
            this.$root.spinner = true;
            Admin.logout();
        }
    },
    created() {
        this.logged_id = Admin.id();
        this.role_name = Admin.role();
        this.logged_name = Admin.name();
    }
};
</script>
