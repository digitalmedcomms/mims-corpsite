<div id="contact">
    <div class="page-banner">
    <!-- <div class="page-banner" style="background: url('<?php echo IMG_URL . 'global-map-bg.png'; ?>'); background-size: cover;"> -->
        <div id="highchart" style="height: 100%;"></div>
    </div>

    <div id="contact-form-container">
        <div id="locations-container" style="background: url('<?php echo IMG_URL . 'contact-us-locations-bg.png'; ?>') bottom right no-repeat;background-color: #1a376d;background-size: 64%;">
            <p class="text-white">Choose location</p>
            <div class="form-group">
            <select name="countries" id="countries" class="selectpicker form-control">
                    <?php foreach($countries as $country){ ?>
                    <option value="<?php echo $country['code']; ?>"><?php echo $country['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="notice mt-3">
                <p class="text-gray">Complete the form and send. The team will get back to you shortly.</p>
            </div>
            <div id="offices">
            </div>
        </div>
        <div id="contact-form">
            <h2 class="text-dblue">Get in touch</h2>
            <div id="formMessage">
                
            </div>
            <form id="contactForm" method="post" action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control required">
                            <input type="hidden" id="emailRecipient" name="emailRecipient">
                            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                            <input type="hidden" name="<?php echo csrf_token(); ?>" value="<?php echo csrf_hash(); ?>">
                        </div>
                    </div>
                    <div class="col-md-6" id="emailRecipientExtracFieldContainer"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Organisation</label>
                            <input type="text" name="organisation" id="organisation" class="form-control required">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control required">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Message</label>
                            <textarea name="message" id="message" rows="2" class="form-control required" placeholder="Write your message."></textarea>
                        </div>
                    </div>
                </div>
                <div class="buttons mt-5">
                    <button id="send-message" class="btn btn-blue">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var OFFICES_JSON = <?php echo $offices_json; ?>;
    var RECAPTCHA_SK = '<?php echo $captch_sitekey; ?>';
    var csrfName = '<?= csrf_token() ?>'; 
    var csrfHash = '<?= csrf_hash() ?>'; 
</script>