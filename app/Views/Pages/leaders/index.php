<div id="leaders-container">
    <div class="banner">
        <div class="container">
            <h1 class="text-blue">Our Leadership</h1>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo base_url(); ?>" class="breadcrumb-link">Home</a></li>
                    <li><a href="<?php echo base_url('about-us'); ?>" class="breadcrumb-link">About Us</a></li>
                </ul>
            </div>
        </div>
        <div class="bg-left" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
        <div class="bg-right" style="background: url('<?php echo IMG_URL . 'our-solutions/leading-bg.png'; ?>') center center no-repeat; background-size: cover;"></div>
    </div>

    <div id="leaders">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active" role="presentation">
                    <button class="nav-link active" id="executive-committee-tab" data-bs-toggle="tab" data-bs-target="#executive-committee-tab-pane" type="button" role="tab" aria-controls="executive-committee-tab-pane" aria-selected="true">Regional Leaders</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="country-leaders-tab" data-bs-toggle="tab" data-bs-target="#country-leaders-tab-pane" type="button" role="tab" aria-controls="country-leaders-tab-pane" aria-selected="true">Country Leaders</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="executive-committee-tab-pane" role="tabpanel" aria-labelledby="executive-committee-tab" tabindex="0">
                    <div class="leaders-container">
                        <h3 class="text-blue">Executive Leads</h3>
                        <?php
                            foreach($leader_types[0]['leaders'] as $leader){
                                echo '<div class="leader-item">';
                                    echo '<div class="leader-img"><img src="'.base_url($leader['image_path']).'" alt="'.$leader['name'].'"></div>';
                                    echo '<div class="leader-details"><div class="leader-name text-blue">'.$leader['name'].'</div><div class="leader-designation text">'.$leader['designation'].'</div></div>';
                                    echo '<div class="leader-bio">'.$leader['biography'].'</div>';
                                    echo '<a href="javascript:;" data-leader="'.$leader['id'].'" class="profileLink text-blue text-dmsans">View Profile <i class="fa fa-angle-right"></i></a>';
                                echo '</div>';
                            }
                        ?>
                        <h3 class="text-blue">Regional Leads</h3>
                        <?php
                            foreach($leader_types[2]['leaders'] as $leader){
                                echo '<div class="leader-item">';
                                    echo '<div class="leader-img"><img src="'.base_url($leader['image_path']).'" alt="'.$leader['name'].'"></div>';
                                    echo '<div class="leader-details"><div class="leader-name text-blue">'.$leader['name'].'</div><div class="leader-designation text">'.$leader['designation'].'</div></div>';
                                    echo '<div class="leader-bio">'.$leader['biography'].'</div>';
                                    echo '<a href="javascript:;" data-leader="'.$leader['id'].'" class="profileLink text-blue text-dmsans">View Profile <i class="fa fa-angle-right"></i></a>';
                                echo '</div>';
                            }
                        ?>
                        
                    </div>
                </div>
                <div class="tab-pane fade" id="country-leaders-tab-pane" role="tabpanel" aria-labelledby="country-leaders-tab" tabindex="0">
                    <div class="leaders-container">
                        <?php
                            foreach($leader_types[1]['leaders'] as $leader){
                                echo '<div class="leader-item">';
                                    echo '<div class="leader-img"><img src="'.base_url($leader['image_path']).'" alt="'.$leader['name'].'"></div>';
                                    echo '<div class="leader-details"><div class="leader-name text-blue">'.$leader['name'].'</div><div class="leader-designation text">'.$leader['designation'].'</div></div>';
                                    echo '<div class="leader-bio">'.$leader['biography'].'</div>';
                                    echo '<a href="javascript:;" data-leader="'.$leader['id'].'" class="profileLink text-blue text-dmsans">View Profile <i class="fa fa-angle-right"></i></a>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
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