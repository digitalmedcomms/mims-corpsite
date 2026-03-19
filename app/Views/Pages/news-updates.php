

<div id="news-updates-container">
    <div class="banner">
        <div class="container">
            <h1 class="text-blue">News & Updates</h1>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>" class="breadcrumb-link">Home</a></li>
                    <li><a href="<?php echo base_url('news-updates'); ?>" class="breadcrumb-link">News & Updates</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-left" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
        <div class="bg-right" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
    </div>

    <div class="container">
        <div id="postsContainer">
            <div id="postList">
                    <?php 
                    if(count($articles) > 0) { 
                        foreach($articles as $year => $article_arr){
                            echo '<div class="post-list-container">';
                                echo '<div class="post-list-header"><h2 id="'.$year.'" class="text-blue">'.$year.'</h2></div>';
                                echo '<div class="post-list-items '.( $year == date("Y") ? 'current-year' : '' ).'">';

                                foreach($article_arr as $article){
                                    echo '<div class="post-item">';
                                        echo '<div class="post-item-featured-img" style="background: url(\''.base_url($article['featured_img_path']).'\') center center no-repeat; background-size: cover;"></div>';
                                        echo '<div class="post-item-details">';
                                            echo '<div class="post-item-detail">';
                                                echo '<span class="category-name">'.$article['category_name'].'</span>';
                                                echo '<span class="post-date">'.$article['date_formatted'].'</span>';
                                            echo '</div>';
                                            echo '<div class="post-item-detail">';
                                                echo '<div class="post-title text-blue ellipsis">'.$article['title'].'</div>';
                                                echo '<p class="post-description text-grayish-blue ellipsis">'.$article['short_description'].'</p>';
                                            echo '</div>';
                                            echo '<div class="post-item-buttons">';
                                                echo '<a href="'.base_url($article['post_url']).'" class="btn btn-blue">Read More</a>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>
            </div>
            <?php if(count($articles) > 0) { ?>
            <div id="postLinks">
                <div id="archiveList">
                    <div class="archive-header">
                        Archive
                    </div>
                    <div class="archive-body">
                        <ul>
                            <?php 
                                $ctr = 0;
                                foreach($articles as $year => $article_arr){ 
                                    echo '<li><a href="javascript:;" data-target="'.$year.'" class="archive-link '.($ctr == 0 ? 'active' : '').'">'.$year.'</a></li>';
                                    $ctr++;
                                } 
                                
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
