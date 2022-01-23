<template>
    <div>
        <!-- Sidebar -->

        <ul
            class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
            id="accordionSidebar"
        >
            <!-- Sidebar - Brand -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0" />

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link active text-left'
                            : 'nav-link active'
                    "
                    :to="{ name: 'Main' }"
                >
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span class="text-light">{{
                        $t("Dashboard")
                    }}</span></router-link
                >
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider" />

            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->

            <li class="nav-item">
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Main' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Admin Accounts") }}</span>
                </router-link>
            </li>
            <li
                :class="
                    $i18n.locale == 'ar' ? 'float-right nav-item' : 'nav-item'
                "
            >
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Products' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Products") }}</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Orders' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Orders") }}</span>
                </router-link>
            </li>

            <li
                :class="
                    $i18n.locale == 'ar' ? 'nav-item text-left ' : 'nav-item'
                "
            >
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'MainUserAdmin' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Users control") }}</span>
                </router-link>
            </li>
            <li
                :class="
                    $i18n.locale == 'ar' ? 'nav-item text-left ' : 'nav-item'
                "
            >
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Departments' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Departments") }}</span>
                </router-link>
            </li>

            <li
                :class="
                    $i18n.locale == 'ar' ? 'text-left nav-item' : 'nav-item'
                "
            >
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Trademarks' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Trademarks") }}</span>
                </router-link>
            </li>

            <li
                :class="
                    $i18n.locale == 'ar' ? 'float-right nav-item' : 'nav-item'
                "
            >
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Colors' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Colors") }}</span>
                </router-link>
            </li>
            <li
                :class="
                    $i18n.locale == 'ar' ? 'float-right nav-item' : 'nav-item'
                "
            >
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Sizes' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Sizes") }}</span>
                </router-link>
            </li>
            <li
                :class="
                    $i18n.locale == 'ar' ? 'float-right nav-item' : 'nav-item'
                "
            >
                <router-link
                    :class="
                        $i18n.locale == 'ar'
                            ? 'nav-link collapsed text-left'
                            : 'nav-link collapsed'
                    "
                    :to="{ name: 'Weights' }"
                >
                    <i class="fas fa-fw fa-cog"></i>
                    <span>{{ $t("Weights") }}</span>
                </router-link>
            </li>
            
        </ul>
    </div>
</template>
