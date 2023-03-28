<template>
    <div class="wrapper">
        <!-- ========== Topbar Start ========== -->
        <Header />
        <!-- ========== Topbar End ========== -->
        <!-- ========== Left Sidebar Start ========== -->
        <LeftMenu />
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">
                <ValidationMessage></ValidationMessage>
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <Breadcrumbs></Breadcrumbs>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <router-view></router-view>
                        </div>
                    </div>
                </div>
                <!-- container -->
            </div>
            <!-- content -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->
</template>

<script>
    import Header from "./../../components/backend/Header";
    import LeftMenu from "./../../components/backend/LeftMenu";
    import Footer from "./../../components/backend/Footer";
    import Breadcrumbs from "./../../components/backend/elements/Breadcrumbs";
    import ValidationMessage from "./../../components/backend/elements/ValidationMessage";
    export default {
        components: {
            Breadcrumbs,
            Header,
            LeftMenu,
            Footer,
            ValidationMessage
        },
        data() {
            return {
                isMainLoader: false,
                html:null,
                config:{},
                defaultConfig:null,
            };
        },

        methods:{
            constructor() {
                this.html = document.getElementsByTagName('html')[0]
                this.config = {};
                this.defaultConfig = window.config;
            },

            initConfig() {
                this.defaultConfig = JSON.parse(JSON.stringify(window.defaultConfig));
                this.config = JSON.parse(JSON.stringify(window.config));
                this.setSwitchFromConfig();
            },

            changeLeftbarColor(color) {
                this.config.sidenav.color = color;
                this.html.setAttribute('data-sidenav-color', color);
                this.setSwitchFromConfig();
            },

            changeLeftbarSize(size, save = true) {
                this.html.setAttribute('data-sidenav-size', size);
                if (save) {
                    this.config.sidenav.size = size;
                    this.setSwitchFromConfig();
                }
            },

            changeLayoutMode(mode, save = true) {
                this.html.setAttribute('data-layout-mode', mode);
                if (save) {
                    this.config.layout.mode = mode;
                    this.setSwitchFromConfig();
                }
            },

            changeLayoutPosition(position) {
                this.config.layout.position = position;
                this.html.setAttribute('data-layout-position', position);
                this.setSwitchFromConfig();
            },

            changeLayoutColor(color) {
                this.config.theme = color;
                this.html.setAttribute('data-theme', color);
                this.setSwitchFromConfig();
            },

            changeTopbarColor(color) {
                this.config.topbar.color = color;
                this.html.setAttribute('data-topbar-color', color);
                this.setSwitchFromConfig();
            },

            changeSidebarUser(showUser) {

                this.config.sidenav.user = showUser;
                if (showUser) {
                    this.html.setAttribute('data-sidenav-user', showUser);
                } else {
                    this.html.removeAttribute('data-sidenav-user');
                }
                this.setSwitchFromConfig();
            },

            resetTheme() {
                this.config = JSON.parse(JSON.stringify(window.defaultConfig));
                this.changeLeftbarColor(this.config.sidenav.color);
                this.changeLeftbarSize(this.config.sidenav.size);
                this.changeLayoutColor(this.config.theme);
                this.changeLayoutMode(this.config.layout.mode);
                this.changeLayoutPosition(this.config.layout.position);
                this.changeTopbarColor(this.config.topbar.color);
                this.changeSidebarUser(this.config.sidenav.user);
                this._adjustLayout();
            },

            initSwitchListener() {
                var self = this;
                document.querySelectorAll('input[name=data-sidenav-color]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        self.changeLeftbarColor(element.value);
                    })
                });
                document.querySelectorAll('input[name=data-sidenav-size]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        self.changeLeftbarSize(element.value);
                    })
                });

                document.querySelectorAll('input[name=data-theme]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        self.changeLayoutColor(element.value);
                    })
                });
                document.querySelectorAll('input[name=data-layout-mode]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        self.changeLayoutMode(element.value);
                    })
                });

                document.querySelectorAll('input[name=data-layout-position]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        self.changeLayoutPosition(element.value);
                    })
                });
                document.querySelectorAll('input[name=data-layout]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        window.location = element.value === 'horizontal' ? 'layouts-horizontal.html' : 'index.html'
                    })
                });
                document.querySelectorAll('input[name=data-topbar-color]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        self.changeTopbarColor(element.value);
                    })
                });
                document.querySelectorAll('input[name=sidebar-user]').forEach(function (element) {
                    element.addEventListener('change', function (e) {
                        self.changeSidebarUser(element.checked);
                    })
                });

                //TopBar Light Dark
                var themeColorToggle = document.getElementById('light-dark-mode');
                if (themeColorToggle) {
                    themeColorToggle.addEventListener('click', function (e) {

                        if (self.config.theme === 'light') {
                            self.changeLayoutColor('dark');
                        } else {
                            self.changeLayoutColor('light');
                        }
                    });
                }

                var resetBtn = document.querySelector('#reset-layout')
                if (resetBtn) {
                    resetBtn.addEventListener('click', function (e) {
                        self.resetTheme();
                    });
                }

                var menuToggleBtn = document.querySelector('.button-toggle-menu');
                if (menuToggleBtn) {
                    menuToggleBtn.addEventListener('click', function () {
                        var configSize = self.config.sidenav.size;
                        var size = self.html.getAttribute('data-sidenav-size', configSize);

                        if (size !== 'full') {
                            if (size === 'condensed') {
                                self.changeLeftbarSize(configSize == 'condensed' ? 'default' : configSize, false);
                            } else {
                                self.changeLeftbarSize('condensed', false);
                            }
                        } else {
                            self.showBackdrop();
                        }

                        // Todo: old implementation
                        self.html.classList.toggle('sidebar-enable');

                    });
                }

                var hoverBtn = document.querySelectorAll('.button-sm-hover');
                hoverBtn.forEach(function (element) {
                    element.addEventListener('click', function () {
                        var configSize = self.config.sidenav.size;
                        var size = self.html.getAttribute('data-sidenav-size', configSize);

                        if (configSize === 'sm-hover') {
                            if (size === 'sm-hover-active') {
                                self.changeLeftbarSize('sm-hover', false);
                            } else {
                                self.changeLeftbarSize('sm-hover-active', false);
                            }
                        }
                    });
                })
            },

            showBackdrop() {
                const backdrop = document.createElement('div');
                backdrop.classList = 'offcanvas-backdrop fade show';
                document.body.appendChild(backdrop);
                document.body.style.overflow = "hidden";
                if (window.innerWidth > 750) {
                    // document.body.style.paddingRight = "15px";
                }
                const self = this
                backdrop.addEventListener('click', function (e) {
                    self.html.classList.remove('sidebar-enable');
                    document.body.removeChild(backdrop);
                    document.body.style.overflow = null;
                    // document.body.style.paddingRight = null;
                })
            },

            initWindowSize() {
                var self = this;
                window.addEventListener('resize', function (e) {
                    self._adjustLayout();
                })
            },

            _adjustLayout() {
                var self = this;

                if (window.innerWidth <= 750) {
                    self.changeLeftbarSize('full', false);
                }
                else if (window.innerWidth >= 750 && window.innerWidth <= 1140) {
                    if (self.config.sidenav.size !== 'full') {
                        if (self.config.sidenav.size === 'sm-hover') {
                            self.changeLeftbarSize('condensed');
                        } else {
                            self.changeLeftbarSize('condensed', false);
                        }
                    }
                    if (self.config.layout.mode === 'boxed') {
                        self.changeLayoutMode('fluid', false)
                    }

                } else {
                    self.changeLeftbarSize(self.config.sidenav.size);
                    self.changeLayoutMode(self.config.layout.mode);
                }
            },

            setSwitchFromConfig() {

                sessionStorage.setItem('__HYPER_CONFIG__', JSON.stringify(this.config));
                // localStorage.setItem('__HYPER_CONFIG__', JSON.stringify(this.config));

                document.querySelectorAll('.right-bar input[type=checkbox]').forEach(function (checkbox) {
                    checkbox.checked = false;
                })

                var config = this.config;
                if (config) {
                    var layoutNavSwitch = document.querySelector('input[type=radio][name=data-layout][value=' + config.nav + ']');
                    var layoutColorSwitch = document.querySelector('input[type=radio][name=data-theme][value=' + config.theme + ']');
                    var layoutModeSwitch = document.querySelector('input[type=radio][name=data-layout-mode][value=' + config.layout.mode + ']');
                    var topbarColorSwitch = document.querySelector('input[type=radio][name=data-topbar-color][value=' + config.topbar.color + ']');
                    var leftbarColorSwitch = document.querySelector('input[type=radio][name=data-sidenav-color][value=' + config.sidenav.color + ']');
                    var leftbarSizeSwitch = document.querySelector('input[type=radio][name=data-sidenav-size][value=' + config.sidenav.size + ']');
                    var layoutSizeSwitch = document.querySelector('input[type=radio][name=data-layout-position][value=' + config.layout.position + ']');
                    var sidebarUserSwitch = document.querySelector('input[type=checkbox][name=sidebar-user]');

                    if (layoutNavSwitch) layoutNavSwitch.checked = true;
                    if (layoutColorSwitch) layoutColorSwitch.checked = true;
                    if (layoutModeSwitch) layoutModeSwitch.checked = true;
                    if (topbarColorSwitch) topbarColorSwitch.checked = true;
                    if (leftbarColorSwitch) leftbarColorSwitch.checked = true;
                    if (leftbarSizeSwitch) leftbarSizeSwitch.checked = true;
                    if (layoutSizeSwitch) layoutSizeSwitch.checked = true;
                    if (sidebarUserSwitch && config.sidenav.user.toString() === "true") sidebarUserSwitch.checked = true;
                }
            },

            init() {
                this.constructor();
                this.initConfig();
                this.initSwitchListener();
                this.initWindowSize();
                this._adjustLayout();
                this.setSwitchFromConfig();
            }
        },
        created() {
            this.$root.$loader.$on("loading", playload => {
                this.isMainLoader = playload;
            });
        },
        mounted() {
            (function ($) {
                'use strict';
                // Topbar Fullscreen Button
                function initfullScreenListener() {
                    var self = this;
                    var fullScreenBtn = document.querySelector('[data-toggle="fullscreen"]');

                    if (fullScreenBtn) {
                        fullScreenBtn.addEventListener('click', function (e) {
                            e.preventDefault();
                            document.body.classList.toggle('fullscreen-enable')
                            if (!document.fullscreenElement && /* alternative standard method */ !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
                                if (document.documentElement.requestFullscreen) {
                                    document.documentElement.requestFullscreen();
                                } else if (document.documentElement.mozRequestFullScreen) {
                                    document.documentElement.mozRequestFullScreen();
                                } else if (document.documentElement.webkitRequestFullscreen) {
                                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                                }
                            } else {
                                if (document.cancelFullScreen) {
                                    document.cancelFullScreen();
                                } else if (document.mozCancelFullScreen) {
                                    document.mozCancelFullScreen();
                                } else if (document.webkitCancelFullScreen) {
                                    document.webkitCancelFullScreen();
                                }
                            }
                        });
                    }
                }
                initfullScreenListener();
            })(jQuery)
            this.init();
        },
        beforeCreate() {
            if (!Admin.id()) {
                Admin.logout();
            }
        }
    };
</script>
<style lang="scss">
    .vdp-datepicker.custom-datepicker input {
        display: block;
        width: 100%;
        border: 0px;
        &:focus{
            outline: 0;
        }
    }
    .vdp-datepicker__calendar{
        left: 0px;
        box-shadow: 0px 4px 4px #4444;
    }
    .has-error span.help-block {
        color: #fa5c7c;
    }
    label.control-label:after {
        content: '*';
        color: #fa5c7c;
        left: 3px;
        position: relative;
        font-size: 15px;
    }
    .form-group {
        margin-bottom: 10px;
        min-height: 60px;
        &.has-error input {
            border-color: #fa5c7c;
            &:after{
                content: "\f05d6";
                color: #fa5c7c;
                font-family: 'Material Design Icons';
            }
        }
        &.has-success input {
            border-color: #0acf97;
            &:after{
                content: "\f012c";
                color: #0acf97;
                font-family: 'Material Design Icons';
            }
        }
    }
    fieldset {
        border: 1px solid #0acf97;
        padding: 28px 20px;
        position: relative;
        margin-top: 30px;
        border-radius: 5px;
        legend{
            border: 1px solid #0acf97;
            position: absolute;
            top: -20px;
            left: 25px;
            width: 20%;
            padding: 0px 14px;
            font-size: 21px;
            background: #fff;
            border-radius: 5px;
        }
    }
    tbody, td, tfoot, th, thead, tr{
        vertical-align: middle;
    }
    .text-red{
        color: #fa5c7c;
    }
    .has-error .vdp-datepicker{
        border-color: #fa5c7c;
    }
    .has-success .vdp-datepicker{
        border-color: #0acf97;
    }
    .custom-control.custom-radio {
        label.custom-control-label {
            margin: 0px 4px;
        }
    }
    a.side-nav-link.active.router-link-active {
        color: #44deed;
    }
    label.custom-file-label {
        display: none;
    }
</style>
