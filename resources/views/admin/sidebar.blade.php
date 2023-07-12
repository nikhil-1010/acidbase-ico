<div class="layout-sidenav">

        <div class="layout-sidenav-nav">
            <nav class="cat-sidenav accordion" id="sidenavAccordion">
                <div class="cat-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link {{\Request::is('admin/dashboard') ? 'active':''}}" id="dashboard" href="{{url('admin/dashboard')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-gauge"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link {{\Request::is('admin/whitelist-account') ? 'active':''}}" id="whitelist" href="{{url('admin/whitelist-account')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-arrow-right-arrow-left"></i></div>
                            Whitelist Account
                        </a>
                        <a class="nav-link {{\Request::is('admin/transaction') ? 'active':''}}" id="transaction" href="{{url('admin/transaction')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                            Transactions
                        </a>
                        <a class="nav-link {{\Request::is('admin/faq') ? 'active':''}}" id="faq" href="{{url('admin/faq')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-question-circle"></i></div>
                            Faq
                        </a>
                        <a class="nav-link {{\Request::is('admin/contacts') ? 'active':''}}" id="contact" href="{{url('admin/contacts')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-id-badge"></i></div>
                            Contacts
                        </a>
                        <!-- <a class="nav-link {{\Request::is('admin/site-content') ? 'active':''}}" id="site_content" href="{{url('admin/site-content')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-money-bill-transfer"></i></div>
                            Site Content
                        </a> -->
                        <a class="nav-link {{\Request::is('admin/settings') ? 'active':''}}" id="setting" href="{{url('admin/settings')}}">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-tools"></i></div>
                            Setting
                        </a>
                        <!-- <a class="nav-link collapsed" href="" data-bs-toggle="collapse" data-bs-target="#collapseBillList" aria-expanded="false" aria-controls="collapseBillList">
                            <div class="cat-nav-link-icon"><i class="fa-solid fa-diagram-project"></i></div>
                            Menu 2
                            <div class="cat-sidenav-collapse-arrow"><i class="fa-solid fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseBillList" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="cat-sidenav-menu-nested nav">
                                <a class="nav-link" href="">
                                    <div class="cat-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                    Sub Menu</a>
                                <a class="nav-link" href="">
                                    <div class="cat-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                    Sub Menu 2</a>
                                <a class="nav-link" href="">
                                    <div class="cat-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                    Sub Menu 3</a>
                            </nav>
                        </div> -->
                    </div>
                </div>
            </nav>
        </div>

        <div class="layout-sidenav-content">

            


            