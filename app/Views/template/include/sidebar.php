<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">Datta Able</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>

        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">

                <!-- NAVIGATION -->
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>

                <li class="nav-item active">
                    <a href="<?= base_url('/') ?>" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>

                <!-- FORMS & TABLE -->
                <li class="nav-item pcoded-menu-caption">
                    <label>Forms & Table</label>
                </li>

                <!-- 🔽 FORM WITH SUB MENU -->
                <li class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link">
                        <span class="pcoded-micon">
                            <i class="feather icon-file-text"></i>
                        </span>
                        <span class="pcoded-mtext">Form</span>
                    </a>

                    <ul class="pcoded-submenu">
                    <li class="nav-item">
                          <a href="<?= base_url('Expense-accounting') ?>">Expense Accounting</a>

                    
                        </li>
                                <li class="nav-item">
                            <a href="<?= base_url('account-statement') ?>" class="nav-link">
                                <span class="pcoded-mtext">Account Balance</span>
                            </a>
                        </li>
                        </li>
                                <li class="nav-item">
                            <a href="<?= base_url('account-group-summary') ?>" class="nav-link">
                                <span class="pcoded-mtext">Account Group Summery</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- TABLE -->
                <!-- <li class="nav-item">
                    <a href="tbl_bootstrap.html" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-server"></i></span>
                        <span class="pcoded-mtext">Table</span>
                    </a>
                </li> -->

            </ul>
        </div>
    </div>
</nav>
