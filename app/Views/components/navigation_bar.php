<style>
    .nav-link.active {
        color: #be1722 !important;
    }
</style>
<header id="navMegaMenu">
    <div class="container">
        <nav class="navbar navbar-expand-lg wow bounceInDown navbar-light" data-wow-duration="0.5s">
            <a class="nav-link nav-logo" href="<?php echo base_url(); ?>"><img class="logo" src="<?php echo base_url('assets/img/mims.png'); ?>"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                    </li> -->
                    <li class="nav-item class-mega dropdown has-megamenu">
                        <a class="nav-link <?php echo (isset($nav) && $nav == 'aboutus' ? 'active' : ''); ?>" href="<?php echo base_url('about-us'); ?>">About Us</a>
                        <a class="mega-menu-dropdown dropdown-toggle" type="button" href="#" data-bs-toggle="dropdown"><i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu collapse navMegaMenu" id="navMegaMenuAboutUs" data-bs-popper="none">
                            <div class="mega-content px-sm-4">
                                <div class="container-fluid">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-sm-4 col-md-3 py-sm-4  border-right">
                                            <h5 class="text-red" style="color:#be1722;">Get to know how MIMS can make the difference for your business</h5>
                                        </div> 
                                        <div class="col-12 col-sm-8 col-md-9">
                                            <div class="solutions-mega-menu">
                                                <div class="menu-item border-right">
                                                    <a href="<?php echo base_url('about-us/#our-advantage'); ?>" class="link-header text-red" style="color:#be1722;">Our Advantage</a>
                                                    <p>Read the business values that ground our commitment to your success</p>
                                                </div>
                                                <div class="menu-item border-right">
                                                    <a href="<?php echo base_url('about-us/#timeline'); ?>" class="link-header text-red" style="color:#be1722;">Our Story</a>
                                                    <p>Founded in 1963, learn more about our pioneering journey to date</p>
                                                </div>
                                                <div class="menu-item">
                                                    <a href="<?php echo base_url('about-us/#our-people'); ?>" class="link-header text-red" style="color:#be1722;">Our People</a>
                                                    <p>Meet <a href="<?php echo base_url('our-leaders'); ?>" class="text-blue">our leadership</a> and see our various locations in 17 markets</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item class-mega dropdown has-megamenu">
                        <a class="nav-link <?php echo (isset($nav) && $nav == 'solutions' ? 'active' : ''); ?>" href="<?php echo base_url('our-solutions'); ?>" style="display: inline-block;">Our Solutions</a>
                        <a class="mega-menu-dropdown dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu collapse megamenu navMegaMenu" id="navMegaMenuSolutions" data-bs-popper="none">
                            <div class="mega-content px-sm-4">
                                <div class="container-fluid">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-sm-4 col-md-3 py-sm-4 border-right">
                                            <h5 class="text-red" style="color:#be1722;">Trust MIMS to be your strategic partner for healthcare knowledge solutions and services</h5>
                                        </div>
                                        <div class="col-12 col-sm-8 col-md-9 border-left">
                                            <div class="solutions-mega-menu">
                                                <div class="menu-item border-right">
                                                    <a href="<?php echo base_url('our-solutions/for-hcp'); ?>" class="link-header text-red" style="color:#be1722;">For Healthcare Professionals</a>
                                                    <ul>
                                                        <li><a href="<?php echo base_url('our-solutions/for-hcp#drug-references-and-guidelines'); ?>" class="link-menu">Drug References & Guidelines</a></li>
                                                        <li><a href="<?php echo base_url('our-solutions/for-hcp#clinical-decision-solutions'); ?>" class="link-menu">Clinical Decision Solutions</a></li>
                                                        <li><a href="<?php echo base_url('our-solutions/for-hcp#professional-development'); ?>" class="link-menu">Professional Development</a></li>
                                                    </ul>
                                                </div>
                                                <div class="menu-item border-right">
                                                    <a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies'); ?>" class="link-header text-red" style="color:#be1722;">For Pharmaceutical Companies</a>
                                                    <ul>
                                                        <li><a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies#medical-communications'); ?>" class="link-menu">Medical Communications</a></li>
                                                        <li><a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies#drug-listing'); ?>" class="link-menu">Drug Listing</a></li>
                                                        <li><a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies#marketing-platform'); ?>" class="link-menu">Marketing Platform</a></li>
                                                    </ul>
                                                </div>
                                                <div class="menu-item">
                                                    <a href="<?php echo base_url('our-solutions/for-healthcare-institutions'); ?>" class="link-header text-red" style="color:#be1722;">For Healthcare Institutions</a>
                                                    <ul>
                                                        <li><a href="<?php echo base_url('our-solutions/for-healthcare-institutions#clinical-decision-solutions'); ?>" class="link-menu">Clinical Decision Solutions</a></li>
                                                        <li><a href="<?php echo base_url('our-solutions/for-healthcare-institutions#hcp-recruitment'); ?>" class="link-menu">Global HCP Recruitment</a></li>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  <?php echo (isset($nav) && $nav == 'news-updates' ? 'active' : ''); ?>" href="<?php echo base_url('news-updates'); ?>">News & Updates</a>
                    </li>
                    <li class="nav-item class-mega has-megamenu dropdown">
                        <a class="nav-link  <?php echo (isset($nav) && $nav == 'joinus' ? 'active' : ''); ?>" href="<?php echo base_url('join-us'); ?>">Join Us</a>
                        <a class="mega-menu-dropdown dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fa fa-angle-down"></i></a>
                        <div class="dropdown-menu collapse megamenu navMegaMenu" id="navMegaMenuJoinUs" data-bs-popper="none">
                            <div class="mega-content px-sm-4">
                                <div class="container-fluid">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-sm-4 col-md-3 py-sm-4 border-right">
                                            <h5 class="text-red" style="color:#be1722;">Join over 1,000 talented individuals across 35 offices in 17 markets</h5>
                                        </div>
                                        <div class="col-12 col-sm-8 col-md-9 border-left">
                                            <div class="solutions-mega-menu">
                                                <div class="menu-item border-right">
                                                    <a href="<?php echo base_url('join-us'); ?>" class="link-header text-red" style="color:#be1722;">Our Core Values</a>
                                                    <p>Read about our three core values that help shape the work culture at MIMS</p>
                                                </div>
                                                <div class="menu-item">
                                                    <a href="<?php echo base_url('join-us#jobs'); ?>" class="link-header text-red" style="color:#be1722;">We're Hiring!</a>
                                                    <p>Find opportunities at MIMS</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="navBtn">
                    <a href="<?php echo base_url('contact-us'); ?>" class="btn btn-blue">Contact Us</a>
                </div>
            </div>
        </nav>
    </div>
</header>