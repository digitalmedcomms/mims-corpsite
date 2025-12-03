<div id="companies-container">
    <div class="banner">
        <div class="container">
            <h1 class="text-blue">For Pharmaceutical Companies</h1>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="" class="breadcrumb-link">Home</a></li>
                    <li><a href="" class="breadcrumb-link">Our Solutions</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-left" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
        <div class="bg-right" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
    </div>

    <div class="container">
        <div id="medical-communications" class="section">
            <div class="two-cols-header">
                <div class="header-title">
                    <h2 class="text-blue">Medical Communications</h2>
                </div>
                <div class="header-description text-grayish-blue">
                    <p>MIMS Is your full-service agency partner for impactful, tailor-made medcomms solutions.</p>
                    <p>With our 250+ strong team of health communication specialists, we have the right expertise to guide you in every step of the way to ensure your marketing and medical go-to-market plans are effective and Integrated.</p>
                </div>
            </div>

            <div id="medcomms-images-carousel" class="owl-carousel owl-theme wow fadeIn">
                <?php foreach($medcomms_carousel['slides'] as $slide){ ?>
                    <div class="item">
                        <div class="img-carousel"  style="background: url('<?php echo base_url($slide['image_filepath']); ?>') center center no-repeat;background-size: cover;">

                        </div>
                    </div>
                <?php } ?>
            </div>

            <div id="medcomms-title-carousel" class="owl-carousel owl-theme wow fadeIn">
                <?php foreach($medcomms_carousel['slides'] as $slide){ ?>
                    <div class="item">
                        <a href="javascript:;" class="carousel-link"><?php echo $slide['title']; ?></a>
                    </div>
                <?php } ?>
            </div>

            <div id="medcomms-desc-carousel" class="owl-carousel owl-theme wow fadeIn">
                <?php foreach($medcomms_carousel['slides'] as $slide){ ?>
                    <div class="item">
                       <?php echo $slide['description']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <div id="drug-listing">
        <div class="section">
            <div class="section-bg-img bg-left" style="background: url('<?php echo IMG_URL . 'our-solutions/companies/drug-listing-img.png'; ?>') center center no-repeat;background-size: cover;"></div>
            <div class="container">
                <div class="section-two-cols">
                    <div class="col-item"></div>
                    <div class="col-item">
                        <h2 class="text-blue">Drug Listing</h2>
                        <div class="desc text-grayish-blue">
                            <p>Leverage this time-tested repository of up-to-date drug information to extend your brand reach to a network of <strong>over 2 million healthcare professionals and key decision makers in the healthcare space</strong></p>
                            <p>Backed by a credible team made up of medically trained writers and editors, our listing provide comprehensive and accurate drug information to healthcare professionals who use it in their dally medical practice.</p>
                            <p><span class="text-blue"><strong>98%</strong></span> of CPs regard MIMS Is a trusted source of information<br>
                            <span class="text-blue"><strong>50%</strong></span> of HGPs USe MIMS dally<br>
                            (Source: xxx)</p>
                        </div>
                        <div class="buttons">
                            <a href="https://mims.com" target="_blank" class="btn btn-red">Access now at mims.com <i class="fa fa-arrow-right"></i></a>
                            <!-- <a href="#" class="btn btn-secondary">Download brochure <i class="fa fa-arrow-right"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div id="marketing-platform" class="section">
            <div class="two-cols-header">
                <div class="header-title">
                    <h2 class="text-blue">Marketing Platform</h2>
                </div>
                <div class="header-description text-grayish-blue">
                    <p>MIMS's multi-channel ecosystem is Asia's #1 clinical and educational resource for healthcare professionals.</p>
                    <p>Utilizing our channels, we provide a spectrum of services including <strong>sponsored content, online/offline ads, targeted EDM campaigns, surveys</strong> and <strong>accredited education</strong>.</p>
                </div>
            </div>

            <div id="marketing-images-carousel" class="owl-carousel owl-theme wow fadeIn">
                <?php foreach($mpf_carousel['slides'] as $slide){ ?>
                    <div class="item">
                        <div class="img-carousel"  style="background: url('<?php echo base_url($slide['image_filepath']); ?>') center center no-repeat;background-size: cover;">

                        </div>
                    </div>
                <?php } ?>
            </div>

            <div id="marketing-title-carousel" class="owl-carousel owl-theme wow fadeIn">
                <?php foreach($mpf_carousel['slides'] as $slide){ ?>
                    <div class="item">
                        <a href="javascript:;" class="carousel-link"><?php echo $slide['title']; ?></a>
                    </div>
                <?php } ?>
            </div>

            <div id="marketing-desc-carousel" class="owl-carousel owl-theme wow fadeIn">
                <?php foreach($mpf_carousel['slides'] as $slide){ ?>
                    <div class="item">
                       <?php echo $slide['description']; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>