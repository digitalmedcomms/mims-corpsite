<style>
    .nav-link.active {
        color: #be1722 !important;
    }
    .announcement-bar {
        background-color: #e5efef;
        width: 100%;
        padding: 7px 0;
        line-height: 1;
        position: relative;
        z-index: 1000;
        transition: max-height 0.3s ease, opacity 0.25s ease, padding 0.3s ease;
        overflow: hidden;
    }
    .announcement-bar .container {
        padding: 0 45px 0 15px;
        position: relative;
    }
    .announcement-bar-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }
    .announcement-bar-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        text-decoration: none !important;
        cursor: pointer;
    }
    .announcement-bar-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #24345f;
        line-height: 1.3;
        letter-spacing: -0.01em;
        text-decoration: none !important;
    }
    .announcement-bar-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: #24345f;
        color: #ffffff !important;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 500;
        line-height: 1;
        padding: 9px 12px;
        border-radius: 0;
        white-space: nowrap;
        text-decoration: none !important;
        transition: background-color 0.2s ease, box-shadow 0.2s ease;
    }
    .announcement-bar-btn i {
        font-size: 11px;
        transition: transform 0.2s ease;
    }
    .announcement-bar-link:hover .announcement-bar-btn {
        background-color: #172445;
    }
    .announcement-bar-link:hover .announcement-bar-btn i {
        transform: translateX(3px);
    }
    .announcement-bar-close {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        outline: none;
        padding: 4px;
        margin: 0;
        color: #24345f;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        border-radius: 4px;
        transition: color 0.2s ease, background-color 0.2s ease, transform 0.15s ease;
    }
    .announcement-bar-close:hover {
        color: #be1722;
        background-color: rgba(36, 52, 95, 0.08);
    }
    .announcement-bar-close:active {
        transform: translateY(-50%) scale(0.92);
    }
    .announcement-bar-close:focus {
        outline: none;
    }
    .announcement-bar-close svg {
        display: block;
    }
    @media (max-width: 991px) {
        .announcement-bar {
            padding: 6px 0;
        }
        .announcement-bar .container {
            padding: 0 40px 0 15px;
        }
        .announcement-bar-text {
            font-size: 13px;
        }
        .announcement-bar-btn {
            font-size: 12px;
            padding: 4px 10px;
        }
    }
    @media (max-width: 767px) {
        .announcement-bar {
            padding: 8px 0;
        }
        .announcement-bar .container {
            padding: 0 35px 0 10px;
        }
        .announcement-bar-link {
            flex-wrap: wrap;
            gap: 6px 10px;
            text-align: center;
        }
        .announcement-bar-text {
            font-size: 12.5px;
            width: 100%;
            display: block;
        }
        .announcement-bar-btn {
            font-size: 11.5px;
            padding: 4px 10px;
        }
        .announcement-bar-close {
            right: 8px;
        }
    }
</style>
<?php
$isHomePage = false;
if (isset($is_home) && $is_home) {
    $isHomePage = true;
} elseif (isset($nav) && $nav === 'home') {
    $isHomePage = true;
} else {
    try {
        $currentUri = trim(service('request')->getUri()->getPath(), '/');
        if (str_starts_with($currentUri, 'index.php/')) {
            $currentUri = substr($currentUri, 10);
        } elseif ($currentUri === 'index.php') {
            $currentUri = '';
        }
        if ($currentUri === '' || $currentUri === 'home') {
            $isHomePage = true;
        }
    } catch (\Throwable $e) {
        $isHomePage = false;
    }
}
?>
<header id="navMegaMenu">
    <?php if ($isHomePage): ?>
        <div class="announcement-bar" id="homepageAnnouncementBar">
            <div class="container">
                <div class="announcement-bar-wrap">
                    <a href="https://corporate.mims.com/corporate/mims-accelerates-product-innovation-and-international-growth" target="_blank" rel="noopener noreferrer" class="announcement-bar-link">
                        <span class="announcement-bar-text">MIMS Accelerates Product Innovation and International Growth</span>
                        <span class="announcement-bar-btn">
                            <span>Read the full press release</span>
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </span>
                    </a>
                </div>
                <button type="button" class="announcement-bar-close" id="closeAnnouncementBar" aria-label="Close announcement" title="Close">
                    <svg width="14" height="14" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                    </svg>
                </button>
            </div>
        </div>
        <script>
            (function() {
                var closeBtn = document.getElementById('closeAnnouncementBar');
                var bar = document.getElementById('homepageAnnouncementBar');
                if (closeBtn && bar) {
                    closeBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        bar.style.maxHeight = bar.scrollHeight + 'px';
                        bar.offsetHeight;
                        bar.style.opacity = '0';
                        bar.style.maxHeight = '0px';
                        bar.style.paddingTop = '0px';
                        bar.style.paddingBottom = '0px';
                        setTimeout(function() {
                            bar.style.display = 'none';
                        }, 300);
                    });
                }
            })();
        </script>
    <?php endif; ?>
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
                                                    <p class="mb-0">Meet <a href="<?php echo base_url('our-leaders'); ?>" class="text-blue">our leadership</a> and see our various locations in 17 markets. <a class="text-blue" href="<?php echo base_url('message-from-ceo'); ?>">Read Message from the CEO</a></p>
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