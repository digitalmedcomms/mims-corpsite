<article id="article-container">
    <div class="banner">
        <div class="container">
            <h1 class="text-blue"><?php echo $post['title']; ?></h1>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>" class="breadcrumb-link">Home</a></li>
                    <li><a href="<?php echo base_url('news-updates'); ?>" class="breadcrumb-link">News & Update</a></li>
                    <li><a href="javascript:;" class="breadcrumb-link"><?php echo $post['title']; ?></a></li>
                </ul>
            </div>
        </div>
        <div class="bg-left" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
        <div class="bg-right" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
    </div>
    
    <div class="container">
        <div id="articleBody">
            <div class="articleBody">
                <div class="articleFeatured">
                    <img src="<?php echo base_url($post['featured_img_path']); ?>" title="<?php echo $post['title']; ?>" alt_text="<?php echo $post['title']; ?>">
                </div>
                <div class="articleDetails">
                    <div class="article-date">
                        <i class="fa fa-calendar"></i> <?php echo date("M d, Y", strtotime($post['date'])); ?>
                    </div>
                    <div class="article-category">
                        <span><?php echo $category['name']; ?></span>
                    </div>
                </div>
                <hr>
                <div class="articleContent">
                    <?php echo $post['content']; ?>
                </div>
            </div>

            <div id="articleSidebar">
                <?php if(count($latest_posts) > 0) { ?>
                <div id="latestPosts">
                    <div class="latest-post-header">
                        Latest Posts
                    </div>
                    <div class="latest-post-items">
                        <?php foreach($latest_posts as $post){ ?>
                            <a href="<?php echo base_url($post['post_url']); ?>">
                                <div class="latest-post-item">
                                    <div class="latest-post-img" style="background: url('<?php echo base_url($post['featured_img_path']); ?>') center center no-repeat;background-size: cover;"></div>
                                    <div class="latest-post-details">
                                        <div class="latest-post-title ellipsis"><?php echo $post['title']; ?></div>
                                        <div class="latest-post-date"><i class="fa fa-calendar"></i> <?php echo $post['date_formatted']; ?></div>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>

                <?php if(!empty($form)) { ?>
                <div id="articleForm" class="sidebar-form">
                    <div class="form-header">
                        <?php echo $form['name']; ?>
                    </div>
                    <?php if(!empty($form['description'])) { ?>
                        <div class="form-description">
                            <?php echo $form['description']; ?>
                        </div>
                    <?php } ?>
                    <form id="dynamicForm" data-form-id="<?php echo $form['id']; ?>">
                        <div id="fb-render"></div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-red">Submit</button>
                        </div>
                        <div id="form-message" class="mt-2"></div>
                    </form>
                </div>
                <script>
                    var GLOBAL_BASE_URL = '<?= base_url() ?>/';
                    var csrfName = '<?= csrf_token() ?>'; 
                    var csrfHash = '<?= csrf_hash() ?>';
                    var formFields = <?php echo $form['fields']; ?>;
                </script>
                <?php } ?>
            </div>

        </div>
    </div>
</article>