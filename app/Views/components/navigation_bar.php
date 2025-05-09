<header class="">
    <div class="container">
        <nav class="navbar navbar-expand-lg wow bounceInDown navbar-light" data-wow-duration="0.5s">
            <a class="nav-link nav-logo" href="<?php echo base_url(); ?>"><img class="logo" src="<?php echo base_url('assets/img/mims.png'); ?>"></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('about-us'); ?>">About Us</a>
                    </li>
                    <li class="nav-item class-mega">
                        <a class="nav-link" href="<?php echo base_url('our-solutions'); ?>" style="display: inline-block;">Our Solutions</a>
                        <a class="mega-menu-dropdown" href="#" data-bs-toggle="collapse" data-bs-target="#navMegaMenuSolutions" aria-controls="navMegaMenuSolutions" aria-expanded="false" aria-label="Toggle navMegaMenuSolutions navigation"><i class="fa fa-angle-down"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">News & Updates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Join Us</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="dropdown-menu collapse" id="navMegaMenuSolutions">
        <div class="mega-content px-4">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12 col-sm-4 col-md-3 py-4 ">
                        <h5 class="text-red">Trust MIMS to be your strategic partner for healthcare knowledge solutions and services</h5>
                    </div>
                    <div class="col-12 col-sm-8 col-md-9 border-left">
                        <div class="solutions-mega-menu">
                            <div class="menu-item border-right">
                                <a href="<?php echo base_url('our-solutions/for-hcp'); ?>" class="link-header text-red">For Healthcare Professionals</a>
                                <ul>
                                    <li><a href="<?php echo base_url('our-solutions/for-hcp#drug-references-and-guidelines'); ?>" class="link-menu">Drug References & Guidelines</a></li>
                                    <li><a href="<?php echo base_url('our-solutions/for-hcp#clinical-decision-support-tools'); ?>" class="link-menu">Clinical Decision Support Tools</a></li>
                                    <li><a href="<?php echo base_url('our-solutions/for-hcp#professional-development'); ?>" class="link-menu">Professional Development</a></li>
                                </ul>
                            </div>
                            <div class="menu-item border-right">
                                <a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies'); ?>" class="link-header text-red">For Pharmaceutical Companies</a>
                                <ul>
                                    <li><a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies#drug-listing'); ?>" class="link-menu">Drug Listing</a></li>
                                    <li><a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies#medical-communications'); ?>" class="link-menu">Medical Communications</a></li>
                                    <li><a href="<?php echo base_url('our-solutions/for-pharmaceutical-companies#marketing-platform'); ?>" class="link-menu">Marketing Platform</a></li>
                                </ul>
                            </div>
                            <div class="menu-item">
                                <a href="<?php echo base_url('our-solutions/for-healthcare-institutions'); ?>" class="link-header text-red">For Healthcare Institutions</a>
                                <ul>
                                    <li><a href="<?php echo base_url('our-solutions/for-healthcare-institutions#reference-clinical-decision'); ?>" class="link-menu">Reference & Clinical Decision Support</a></li>
                                    <li><a href="<?php echo base_url('our-solutions/for-healthcare-institutions#hcp-recruitment'); ?>" class="link-menu">HCP Recruitment Services</a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>