<div id="leaders-container">
    <div class="banner">
        <div class="container">
            <h1 class="text-blue">Our Leadership</h1>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="" class="breadcrumb-link">Home</a></li>
                    <li><a href="" class="breadcrumb-link">Join Us</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-left" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
        <div class="bg-right" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
    </div>

    <div id="leaders">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php 
                $ctr = 0;
                foreach($leader_types as $leader_type){ ?>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $ctr == 0 ? 'active' : ''; ?>" id="<?php echo str_replace(" ", "", strtolower($leader_type['name'])); ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo str_replace(" ", "", strtolower($leader_type['name'])); ?>-tab-pane" type="button" role="tab" aria-controls="<?php echo str_replace(" ", "", strtolower($leader_type['name'])); ?>-tab-pane" aria-selected="true"><?php echo $leader_type['name']; ?></button>
                    </li>
                <?php 
                $ctr++;
                } ?>
            </ul>
            <div class="tab-content" id="myTabContent">

                <?php 
                $ctr = 0;
                foreach($leader_types as $leader_type){ ?>
                <div class="tab-pane fade <?php echo $ctr == 0 ? 'show active' : ''; ?>" id="<?php echo str_replace(" ", "", strtolower($leader_type['name'])); ?>-tab-pane" role="tabpanel" aria-labelledby="<?php echo str_replace(" ", "", strtolower($leader_type['name'])); ?>-tab" tabindex="0">
                    <div class="leaders-container">
                        <?php
                        if($leader_type['id'] == 3){
                            foreach($leader_type['practices'] as $practice){
                                echo '<h3 class="text-blue">' . $practice['name'] . '</h3>';
                                foreach($practice['leaders'] as $leader){
                                    echo '<div class="leader-item">';
                                        echo '<div class="leader-img"><img src="'.base_url($leader['image_path']).'" alt="'.$leader['name'].'"></div>';
                                        echo '<div class="leader-details"><div class="leader-name text-blue">'.$leader['name'].'</div><div class="leader-designation text">'.$leader['designation'].'</div></div>';
                                        echo '<div class="leader-bio">'.$leader['biography'].'</div>';
                                        echo '<a href="javascript:;" class="profileLink text-blue text-dmsans">View Profile <i class="fa fa-angle-right"></i></a>';
                                    echo '</div>';
                                }
                            }
                        }else{
                            foreach($leader_type['leaders'] as $leader){
                                echo '<div class="leader-item">';
                                    echo '<div class="leader-img"><img src="'.base_url($leader['image_path']).'" alt="'.$leader['name'].'"></div>';
                                    if($leader_type['id'] == 2){
                                        $countries = explode(",", $leader['countries']);
                                        echo '<div class="leader-countries">';
                                        if(!empty($countries)){
                                            foreach($countries as $country){
                                                echo '<img src="'.IMG_URL . 'flag-circle/'.$country.'.png" alt="'.$country.'">';
                                            }
                                        }
                                        echo '</div>';
                                    }
                                    echo '<div class="leader-details"><div class="leader-name text-blue">'.$leader['name'].'</div><div class="leader-designation text">'.$leader['designation'].'</div></div>';
                                    echo '<div class="leader-bio">'.$leader['biography'].'</div>';
                                    echo '<a href="javascript:;"  class="profileLink text-blue text-dmsans">View Profile <i class="fa fa-angle-right"></i></a>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php 
                $ctr++;
                } ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="leaderDetailsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="modalLeader">

        </div>
      </div>
    </div>
  </div>
</div>