
<div id="joinus-container">
    <div class="banner" style="background: url('<?php echo IMG_URL . 'join-us-bg.png'; ?>') center center no-repeat; background-size: cover;">
        <div class="container">
            <h1 class="text-blue">Join Us</h1>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>" class="breadcrumb-link">Home</a></li>
                    <li><a href="javascript:;" class="breadcrumb-link">Join Us</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-left" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
        <div class="bg-right" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
    </div>


    <div id="our-values">
        <div class="container">
            <h2 class="text-blue text-center">Our Values</h2>
            <div class="section-three-cols">
                <div class="col-item wow fadeIn" data-wow-delay="0.5s">
                    <div class="item-icon">
                        <img src="<?php echo IMG_URL . 'joinus/light-bulb-img.png'; ?>" alt="">
                    </div>
                    <div class="item-title text-blue">
                        Insightful
                    </div>
                    <div class="item-subtitle text-blue">Don't get complacent,<br>question the status quo.</div>
                    <div class="item-desc text-grayish-blue">
                        <p>Always looking to question to increase the value of the MIMS experience to both</p>
                    </div>
                </div>
                <div class="col-item wow fadeIn" data-wow-delay="0.8s">
                    <div class="item-icon">
                        <img src="<?php echo IMG_URL . 'joinus/comment-img.png'; ?>" alt="">
                    </div>
                    <div class="item-title text-blue">
                        Engaging
                    </div>
                    <div class="item-subtitle text-blue">We work together<br>with enthusiasm.</div>
                    <div class="item-desc text-grayish-blue">
                        <p>Thus, you must be a team player who can work well with others. Your behaviors must add to a positive, engaged culture at MIMS.</p>
                    </div>
                </div>
                <div class="col-item wow fadeIn" data-wow-delay="1.1s">
                    <div class="item-icon">
                        <img src="<?php echo IMG_URL . 'joinus/gear-img.png'; ?>" alt="">
                    </div>
                    <div class="item-title text-blue">
                        Progressive
                    </div>
                    <div class="item-subtitle text-blue">We think BIG to ensure MIMS is relevant for today, and ready for tomorrow.</div>
                    <div class="item-desc text-grayish-blue">
                        <p>Always looking to the future and embracing change</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div id="job-filter">
            <div class="filter-input">
                <i class="fa fa-search"></i>
                <input type="text" id="job-search" class="form-control" placeholder="Search by: Job title, Position, Keyword...">
            </div>

            <div class="filter-input">
                <i class="fa fa-map"></i>
                <input type="text" id="job-location" class="form-control" placeholder="City or state">
            </div>

            <div class="buttons">
                <a href="javascript:;" id="btn-toggle-filters" class="btn btn-gray"><i class="fa fa-sliders-v"></i> Filters</a>
                <a href="javascript:;" id="btn-find-job" class="btn btn-primary">Find Job</a>
            </div>
        </div>

        <div id="extra-filters" style="display: none; margin-top: 20px;">
            <div id="job-filter" style="border-top: none; padding-top: 0;">
                <div class="filter-input">
                    <label for="job-type" class="d-block mb-1">Job Type</label>
                    <select id="job-type" class="form-control">
                        <option value="">All Job Types</option>
                        <?php foreach($job_types as $key => $value): ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-input" style="margin-left: 20px;">
                    <label for="job-remote-hybrid" class="d-block mb-1">Work Type</label>
                    <select id="job-remote-hybrid" class="form-control">
                        <option value="">All Work Types</option>
                        <?php foreach($job_locations as $key => $value): ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div id="jobs">
            <div class="text-center" style="padding: 100px 0;">
                <i class="fa fa-spinner fa-spin fa-3x text-blue"></i>
            </div>
        </div>
        <div id="pagination" class="mt-4 pb-5"></div>
    </div>
</div>

<script>
    var GLOBAL_BASE_URL = '<?= base_url() ?>/';
    var csrfName = '<?= csrf_token() ?>'; 
    var csrfHash = '<?= csrf_hash() ?>'; 
</script>