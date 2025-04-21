<template>
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="pt-4">

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Stock
                            </span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href="facturation-stock"
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    Stock agence </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href="stock-global"
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    Stock global </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href="stock-global"
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    Famille Nominale </span>
                                </Link>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">PROFORMA
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="facturation-proformat" aria-expanded="false"><i
                                    class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    CREER </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href="liste-personnelle"
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    LISTE </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href=" "
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    CONVERTIS </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href=" "
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    A CONVERTIR </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href="/"
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    TABLEAU DE BORD </span>
                                </Link>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                            aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">ADMIN
                            </span></a>
                        <ul aria-expanded="false" class="collapse first-level">
                            
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href="/liste-generale"
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    LISTE </span>
                                </Link>
                            </li>
                            <!-- <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href=" "
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    LISTE </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href=" "
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    CONVERTIS </span>
                                </Link>
                            </li>
                            <li class="sidebar-item">
                                <Link class="sidebar-link waves-effect waves-dark sidebar-link" href=" "
                                    aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">
                                    A CONVERTIR </span>
                                </Link>
                            </li> -->

                        </ul>
                    </li>


                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<script>
    export default {};
</script>
