<style>
.timeline-kicker{
    background: #ec1e2845;
    border-radius: 5px;
    padding: 5px 10px;
    line-height: 1em;
}
#about #timeline .timeline-container .about-2026 .section-two-cols{
    min-height: unset;
}
#about #timeline .timeline-container .about-2026 .col-item-right{
    margin-left:5%;
    width: 50%;
}
#about #timeline .timeline-container .about-2026 .col-item-right .img-full{
    width: 100%;
    overflow: hidden;
    border-radius: 20px;
    margin: auto;
}
#about #timeline .timeline-container #mims-ai{
    display: none;
}
#about #timeline .timeline-container .about-2026 .col-item-right .img-full img{
    max-width: 100%;
}
.timeline-tab-toggle{
    display: flex;
    align-items: stretch;
    justify-content: center;
    margin-top: 20px;
    gap: 15px;
}
.timeline-tab-toggle .toggle-tab-item{
    padding: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    max-width: 285px;
    border-radius: 10px;
    border:2px solid #8194992e;
    font-size: 15px;
    line-height: 1.2em;
    cursor: pointer;
}
.timeline-tab-toggle .toggle-tab-item.active{
    border: 2px solid #ec1e28;
    background: #ec1e2845;

}
.timeline-tab-toggle .toggle-img{
    width: 45%;
    border-radius: 10px;
    overflow: hidden;
}
.timeline-tab-toggle .toggle-img img{
    max-width: 100%
}
.timeline-tab-toggle .toggle-desc{
    width: 55%;
}
.timeline-tab-toggle .toggle-tab-item .toggle-desc .text-blue{
    font-size: 16px;
}

.timeline-tab-toggle .toggle-tab-item.active .toggle-desc .text-blue{
    color: #2a3360;
}
.timeline-tab-toggle .toggle-tab-item.active .toggle-desc .text-grayish-blue{
    color: #ec1e28;
    font-size: 14px;
}
@media (max-width: 767px){
    #about #timeline .timeline-container .about-2026 .col-item:nth-child(1){
        order: 1;
    }
    #about #timeline .timeline-container .about-2026 .col-item-right{
        margin-left: 0;
        order: 0;
        margin-bottom: 20px;
    }
    .timeline-tab-toggle .toggle-img{
        width: 35%;
    }
    .timeline-tab-toggle .toggle-tab-item .toggle-desc .text-blue{
        font-size: 13px;
    }
    .timeline-tab-toggle .toggle-tab-item{
        line-height: 1em
    }
    .timeline-tab-toggle .toggle-tab-item .toggle-desc{
        width: 60%;
    }
    .timeline-tab-toggle .toggle-tab-item .toggle-desc .text-grayish-blue{
        font-size: 12px;
    }
}
</style>
<div id="about">
    <div class="page-banner">
        <video autoplay muted loop playsinline id="myVideo" poster="<?php echo base_url('assets/img/map.png'); ?>">
            <source src="<?php echo ASSETS_URL . '../videos/MIMS Map Animation.mp4'; ?>" type="video/mp4">
        </video>
        <div class="container">
            <div class="left-side">
                <h1 class="wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">About Us</h1>
                <div class="banner-description wow fadeInUp" data-wow-delay="1.5s">
                    <p>The MIMS symbol <img src="<?php echo base_url('assets/img/mims-logo-icon.png'); ?>" style="width: 20px;"/> represents people interacting with one another, forming a healthcare community and sharing knowledge.</p>
                    <p>With teams spanning 17 countries & regions, we offer best in class services and innovation to drive insightful learning among doctors, healthcare companies, and the entire medical community.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="section-2">
        <div id="our-advantage" class="section">
            <h2 class="text-blue text-center wow fadeInDown">Our Advantage</h2>
            <div class="our-advantage-container section-three-cols">
                <div class="col-item wow fadeIn" data-wow-delay="0.3s">
                    <div class="item-icon"><img src="<?php echo IMG_URL . 'trusted-icon.png'; ?>" alt=""></div>
                    <div class="item-title text-blue">Trusted Medical Resources</div>
                    <div class="item-desc text-grayish-blue">For 60 years, MIMS has been a peerless partner and a trusted source of medical knowledge, empowering healthcare communities to improve lives.</div>
                </div>
                <div class="col-item wow fadeIn" data-wow-delay="0.5s">
                    <div class="item-icon"><img src="<?php echo IMG_URL . 'diverse-icon.png'; ?>" alt=""></div>
                    <div class="item-title text-blue">Diverse Healthcare Solutions</div>
                    <div class="item-desc text-grayish-blue">Best-known for our unique and widely accessed drug directory, MIMS hosts a wealth of healthcare services to healthcare institutions, pharmaceutical companies and healthcare professionals.</div>
                </div>
                <div class="col-item wow fadeIn" data-wow-delay="0.7s">
                    <div class="item-icon"><img src="<?php echo IMG_URL . 'apac-presence-icon.png'; ?>" alt=""></div>
                    <div class="item-title text-blue">Essential APAC Presence</div>
                    <div class="item-desc text-grayish-blue">With offices in 17 markets in Asia Pacific, we have in-depth knowledge of each local market and their unique features, direct networks and relationships with your stakeholders, and can deliver compelling, locally-relevant solutions.</div>
                </div>
            </div>
        </div>

        <div id="timeline" class="section">
            <div class="container">
                <p class="text-blue"><strong>Our Story</strong></p>
            </div>
            <div class="timeline-container timeline-theme-1">
                <div class="horizontal-timeline" id="example">
                    <div class="events-content">
                        <ol>
                            <li class="selected" data-horizontal-timeline='{"date": "16/01/1963"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right wow fadeInRight" data-wow-delay="2s" style="background: url('<?php echo IMG_URL . 'timeline/mims-drug-reference-book-bg.png'; ?>') center center no-repeat;background-size: cover;">
                                        <img src="<?php echo IMG_URL . 'timeline/mims-drug-reference-book.png'; ?>" alt="">
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans wow bounceIn" data-wow-delay="0.5s">1963</h2>
                                                <h3 class="text-blue text-dmsans wow fadeIn" data-wow-delay="0.8s">Launch of MIMS Drug Reference Book</h3>
                                                <div class="desc text-grayish-blue"> 
                                                    <p class="wow fadeIn" data-wow-delay="1.2s">In September 1963, the company's first medical information journal was published in Australia as <strong>Monthly Index of Medical Specialties</strong> - the acronym of which still occupies pride of place as the company's name, MIMS</p>
                                                    <p class="wow fadeIn" data-wow-delay="1.4s">The 1st edition of <strong>Drug Index for Malaysia & Singapore</strong> (DIMS) was published in 1968.</p>
                                                    <p class="wow fadeIn" data-wow-delay="1.6s">The <strong>MIMS Drug Reference Book</strong> was subsequently published across South East Asia - Philippines, Hong Kong, Indonesia, Thailand, Korea, Taiwan, Vietnam, China and India.</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/1974"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-publication-bg.png'; ?>') center center no-repeat;background-size: cover;">
                                        <img src="<?php echo IMG_URL . 'timeline/mims-publication.png'; ?>" alt="">
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">1974 <span style="font-weight: 200;font-size: 70%;">to present</span></h2>
                                                <h3 class="text-blue text-dmsans">Launch of MIMS Publications</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>Since 1974, MIMS JPOG  provides sound continuing medical education for paediatricians, obstetricians, gynaecologists and physicians involved in the care of women and children in Asia.</p>
                                                    <p>MIMS Doctor, Asia's only regional medical news publication, was first published as Asian Medical News in 1983.</p>
                                                    <p>From 2001 to present, the company has launched over a dozen MIMS Specialty Editions including MIMS Cardiology (2002), MIMS Neurology & Psychiatry (2003), MIMS Obstetrics & Gynecology (2004), MIMS Pediatrics (2008), MIMS Oncology (2014) and MIMS Family Medicine (2015).</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>   
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/1985"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-marketing-solution-bg.png'; ?>') center center no-repeat;background-size: cover;"></div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">1985</h2>
                                                <h3 class="text-blue text-dmsans">Launch of Integrated Marketing Solutions</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>Full service, integrated marketing communication plans including strategic planning, advertising and promotion, advertorials, sponsored content, market research, targeted direct mailing lists.</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/1997"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-online-bg.png'; ?>') center center no-repeat;background-size: cover;">
                                        <img src="<?php echo IMG_URL . 'timeline/mims-online-1997.png'; ?>" alt="">
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">1997</h2>
                                                <h3 class="text-blue text-dmsans">Launch of MIMS Online</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>First launched in Australia as the online version of MIMS drug reference guide. When you need instant access to medicines information at your desk or across a network, MIMS Online provides a solution that’s always current.</p>
                                                    <p>MIMS Online provides a wide range of Australian medicines information – full product information, abbreviated product information, drug/drug interaction module and pill identification module, to name a few.</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/2003"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-cds-module-bg.png'; ?>') center center no-repeat;background-size: cover;">
                                        <div class="bordered-img" style="background: url('<?php echo IMG_URL . 'timeline/mims-cds-module.png'; ?>') center center no-repeat;background-size: cover;"></div>
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">2003</h2>
                                                <h3 class="text-blue text-dmsans">Launch of Clinical Decision Support Modules</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>Modules leveraged on the robust MIMS database and sophisticated drug interaction algorithms to empower HCPs and Healthcare Institutions with accurate prescriptions, enhancing patient safety.</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/2008"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-online-bg-2008.png'; ?>') center center no-repeat;background-size: cover;">
                                        <img src="<?php echo IMG_URL . 'timeline/mims-online.png'; ?>" alt="">
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">2008</h2>
                                                <h3 class="text-blue text-dmsans">Launch of MIMS.com</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>MIMS.com was enhanced and relaunched to allow registrations of HCPs onto our platform for easy access to drug information, medical news and updates.</p>
                                                </div>
                                                <div class="buttons">
                                                    <a href="https://mims.com" target="_blank" class="btn btn-secondary">Access now at mims.com <i class="fa fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/2011"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-online-cpd-bg.png'; ?>') center center no-repeat;background-size: cover;"></div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">2011</h2>
                                                <h3 class="text-blue text-dmsans">Launch of MIMS Online CPD</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>The first MIMS Online CPD course – a paediatrics masterclass for Malaysia primary care doctors – was launched in April 2011.</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/2013"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-mobile-app-bg.png'; ?>') center center no-repeat;background-size: cover;">
                                        <img src="<?php echo IMG_URL . 'timeline/mims-mobile-app.png'; ?>" alt="">
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">2013</h2>
                                                <h3 class="text-blue text-dmsans">Launch of MIMS mobile app</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>Drug search is more accurate, fast and easy with MIMS. MIMS Mobile provides the most comprehensive set of tools to support clinicians with all their professional needs.</p>
                                                </div>
                                                <div class="buttons">
                                                    <a href="https://www.mims.com/mobile-app" target="_blank" class="btn btn-secondary">Access now at https://www.mims.com/mobile-app <i class="fa fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/2015"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-hcp-recruitment-bg.png'; ?>') center center no-repeat;background-size: cover;"></div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">2015</h2>
                                                <h3 class="text-blue text-dmsans">Launch of HCP Recruitment Services</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>We provide career opportunities to HCPs by connecting them with healthcare insitutions. </p>
                                                    <p>Our career service professionals can tailor match the institutions' needs to a diverse group of professionals engaged in our platform.</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/2021"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-mobile-app-bg-2021.png'; ?>') center center no-repeat;background-size: cover;">
                                        <img src="<?php echo IMG_URL . 'timeline/mims-mobile-app-2021.png'; ?>" alt="">
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">2021</h2>
                                                <h3 class="text-blue text-dmsans">Launch of MIMS Education and mobile app</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>MIMS Education provides a bespoke curation of topics for healthcare professionals across varying fields and specialties, all carefully crafted by our dedicated team of medical writers. The platform’s expanding catalogue, ease, and accessibility are built on the promise to deliver the latest medical knowledge sought by users across Asia.</p>
                                                    <p>The MEDU mobile app was launched in 2023.</p>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li data-horizontal-timeline='{"date": "23/05/2023"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-60th-anniv-bg.png'; ?>') center center no-repeat;background-size: cover;">
                                        <div class="bordered-img no-border" style="background: url('<?php echo IMG_URL . 'timeline/mims-60th-anniv.png'; ?>') center center no-repeat;background-size: cover;"></div>
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">2023</h2>
                                                <h3 class="text-blue text-dmsans">MIMS 60th anniversary,<br>Launch of eMIMS Plus</h3>
                                                <div class="desc text-grayish-blue">
                                                    <p>60 years on, we continue to offer best in class services and innovation to drive insightful learning among doctors, healthcare companies, and the entire medical community.</p>
                                                    <p><strong>eMIMS Plus</strong> was launched, a completely refreshed drug reference platform offering a single cross-device subscription. With a lighter, faster, and smarter UX when searching for essential medicine information, eMIMS Plus also comes with a host of new features such as Medicines in Pregnancy, Incompatibility quick guide, Medicine Allergy Checker, Dental Medicine Information, and more.</p>
                                                </div>
                                                <div class="buttons">
                                                    <a href="https://emims.plus" target="_blank" class="btn btn-secondary">Access now at emims.plus <i class="fa fa-arrow-right"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-item"></div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- <li data-horizontal-timeline='{"date": "23/05/Present"}'>
                                <div class="section">
                                    <div class="section-bg-img bg-right" style="background: url('<?php echo IMG_URL . 'timeline/mims-present-bg.png'; ?>') center center no-repeat;background-size: cover;">
                                        <div class="bordered-img" style="background: url('<?php echo IMG_URL . 'timeline/mims-present.png'; ?>') center center no-repeat;background-size: cover;"></div>
                                    </div>
                                    <div class="container">
                                        <div class="section-two-cols">
                                            <div class="col-item">
                                                <h2 class="text-red text-dmsans">Present</h2>
                                                <div class="desc text-grayish-blue">
                                                    <i>
                                                        <p>"MIMS has built a remarkable legacy over many decades and today stands as a market leader across healthcare communities in Australia, Hong Kong, Singapore, Malaysia, Korea and other prominent markets. The scale of what we do, the breadth of our reach, and the depth of our relationships across healthcare systems is truly unique.</p>
                                                        <p>At the heart of everything we do is a clear purpose — empowering healthcare communities to improve patient outcomes. That purpose continues to guide our decisions and priorities."</p>
                                                    </i>
                                                    <p><strong>Sohil Goswami</strong><br>CEO, MIMS Group</p>
                                                </div>
                                            </div>
                                            <div class="col-item">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                            
                            <li data-horizontal-timeline='{"date": "23/05/2026"}'>
                                <div class="section">
                                    <div class="container">
                                        <div id="mims-pulse" class="about-2026">
                                            <div class="section-two-cols">
                                                <div class="col-item">
                                                    <h2 class="text-red text-dmsans">2026</h2>
                                                    <h3 class="text-blue text-dmsans mt-3 mb-4">Launch of MIMS Pulse</h3>
                                                    <div class="desc text-grayish-blue">
                                                        <p>MIMS Pulse represents the next evolution of MIMS Clinical Decision Support. The platform brings trusted medicines information into the rhythm of everyday care through a modern architecture designed for faster integration, greater flexibility, and even better medication decision support.</p>
                                                        <p>Built for the evolving needs of healthcare organisations, MIMS Pulse offers flexible deployment options to accommodate different technology environments and operational requirements. It also supports national medicines terminologies and evolving interoperability standards, enabling healthcare organisations to strengthen clinical workflows today while preparing for a more connected digital health ecosystem in the future.</p>                                                        
                                                        <p>By combining trusted MIMS medicines information with adaptable integration and deployment capabilities, MIMS Pulse supports safer prescribing, more efficient workflows, and more informed medication decisions across the care journey.</p>
                                                    </div>
                                                </div>
                                                <div class="col-item col-item-right">
                                                    <div class="img-full">
                                                        <img src="<?php echo IMG_URL. 'timeline/mims-pulse-img.jpg'; ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="mims-ai" class="about-2026">
                                            <div class="section-two-cols">
                                                <div class="col-item">
                                                    <h2 class="text-red text-dmsans">2026</h2>
                                                    <h3 class="text-blue text-dmsans mb-4">Introduction of MIMS Semantic AI Search</h3>
                                                    <div class="desc text-grayish-blue">
                                                        <p>MIMS Semantic AI Search brings a new way for healthcare professionals to discover and access trusted medical information. Powered by semantic search technology, it enables users to explore medical topics through <strong>Disease Semantic Search</strong>, <strong>Drug Semantic Search</strong> and <strong>Disease Summary</strong>, making it easier to find relevant insights beyond traditional keyword searches.</p>
                                                        <p>The launch marks MIMS’s continued commitment to leveraging technology and innovation to make medical information more accessible and useful for healthcare professionals across Asia.</p>
                                                    </div>
                                                    <div class="buttons">
                                                        <a href="https://mims.com" target="_blank" class="btn btn-secondary">Access now at mims.com <i class="fa fa-arrow-right"></i></a>
                                                    </div>

                                                </div>
                                                <div class="col-item col-item-right">
                                                    <div class="img-full">
                                                        <img src="<?php echo IMG_URL. 'timeline/mims-ai.png'; ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="timeline-tab-toggle">
                                            <div class="toggle-tab-item active" data-target="#mims-pulse">
                                                <div class="toggle-img">
                                                    <img src="<?php echo IMG_URL. 'timeline/mims-pulse-img.jpg'; ?>" alt="">
                                                </div>
                                                <div class="toggle-desc">
                                                    <div class="text-blue mb-1"><strong>MIMS Pulse</strong></div>
                                                    <div class="text-grayish-blue">LAUNCH</div>
                                                </div>
                                            </div>
                                            <div class="toggle-tab-item" data-target="#mims-ai">
                                                <div class="toggle-img">
                                                    <img src="<?php echo IMG_URL. 'timeline/mims-ai.png'; ?>" alt="">
                                                </div>
                                                <div class="toggle-desc">
                                                    <div class="text-blue mb-1"><strong>MIMS Semantic<br>AI Search</strong></div>
                                                    <div class="text-grayish-blue">INTRODUCTION</div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div id="our-people" class="section">
            <div class="img-title wow fadeInDown" data-wow-delay="0.5s">
                <img src="<?php echo IMG_URL. 'our-people.png'; ?>" alt="">
            </div>
            <div class="our-people-container">
                <div class="section-three-cols">
                    <div class="col-item wow fadeIn" data-wow-delay="0.8s">
                        <div class="item-img" style="background: url('<?php echo IMG_URL. 'leadership-img.png'; ?>') center center no-repeat;background-size: cover;">
                            <img src="<?php echo IMG_URL. 'leadership-img.png'; ?>" alt="">
                            <div class="item-img-icon"><img src="<?php echo IMG_URL. 'leadership-icon.png'; ?>" alt=""></div>
                        </div>
                        <div class="item-title text-blue">Our Leadership</div>
                        <div class="divider"></div>
                        <div class="item-desc text-grayish-blue">
                            <p>Visionaries. Strategists. Enablers.</p>
                            <p>Meet the dynamic leadership who empower and inspire the people at MIMS.</p>
                            <p><a class="text-blue" href="<?php echo base_url('message-from-ceo'); ?>">Read Message from the CEO</a></p>
                        </div>
                        <div class="buttons">
                            <a href="<?php echo base_url('our-leaders'); ?>" class="btn btn-secondary">Read More</a>
                        </div>
                    </div>
                    <div class="col-item wow fadeIn" data-wow-delay="1.2s">
                        <div class="item-img" style="background: url('<?php echo IMG_URL. 'locations-img.png'; ?>') center center no-repeat;background-size: cover;">
                            <img src="<?php echo IMG_URL. 'locations-img.png'; ?>" alt="">
                            <div class="item-img-icon"><img src="<?php echo IMG_URL. 'location-icon.png'; ?>" alt=""></div>
                        </div>
                        <div class="item-title text-blue">Our Locations</div>
                        <div class="divider"></div>
                        <div class="item-desc text-grayish-blue">
                            <p>Headquartered in Singapore with regional presence across 17 countries and territories.</p>
                            <p>We generate local insights that tailor and direct our solutions to you.</p>
                        </div>
                        <div class="buttons">
                            <a href="<?php echo base_url('contact-us'); ?>" class="btn btn-secondary">Read More</a>
                        </div>
                    </div>
                    <div class="col-item wow fadeIn" data-wow-delay="1.4s">
                        <div class="item-img" style="background: url('<?php echo IMG_URL. 'join-team-img.png'; ?>') center center no-repeat;background-size: cover;">
                            <img src="<?php echo IMG_URL. 'join-team-img.png'; ?>" alt="">
                            <div class="item-img-icon"><img src="<?php echo IMG_URL. 'team-icon.png'; ?>" alt=""></div>
                        </div>
                        <div class="item-title text-blue">Join the team</div>
                        <div class="divider"></div>
                        <div class="item-desc text-grayish-blue">
                            <p>We need YOU to continue our mission of empowering healthcare communities.</p>
                            <p>Grow your career with MIMS.</p>
                        </div>
                        <div class="buttons">
                            <a href="<?php echo base_url('join-us'); ?>" class="btn btn-secondary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                          