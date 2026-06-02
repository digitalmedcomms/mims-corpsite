<?php echo $this->extend('admin/includes/_layout_view') ?>
 
<?php echo $this->section('content') ?>
<style>
    .bg-primary-gradient {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
    }
    .bg-success-gradient {
        background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);
        color: white;
    }
    .bg-warning-gradient {
        background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);
        color: white;
    }
    .bg-danger-gradient {
        background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);
        color: white;
    }
    .metric-card {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 12px !important;
        overflow: hidden;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }
    .metric-card .info-box-icon {
        background-color: rgba(255, 255, 255, 0.2) !important;
        border-radius: 10px !important;
        margin: auto 15px;
        width: 50px;
        height: 50px;
        min-width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .metric-card .info-box-content {
        padding: 12px 15px 12px 0;
    }
    .dashboard-card-custom {
        border-radius: 12px !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
        border: 1px solid rgba(0,0,0,0.08) !important;
        margin-bottom: 20px;
    }
    .dashboard-card-custom .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid rgba(0,0,0,0.08);
        padding: 15px 20px;
    }
    .btn-custom {
        border-radius: 8px !important;
        padding: 6px 16px;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }
    .btn-custom:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-sm-right d-flex align-items-center">
                        <a href="<?php echo base_url('admin/page-visits/logs'); ?>" class="btn btn-sm btn-primary btn-custom mr-3"><i class="fas fa-list mr-1"></i> View All Visit Logs</a>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo admin_url() ?>"><?php echo trans('dashboard') ?></a></li>
                            <li class="breadcrumb-item active">Page Visits</li>
                        </ol>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <!-- Metrics row -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-primary-gradient">
                        <span class="info-box-icon"><i class="fas fa-eye text-white"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Total Visits (All Time)</span>
                            <span class="info-box-number h3 mb-0"><?php echo number_format($stats_total_all_time); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-success-gradient">
                        <span class="info-box-icon"><i class="fas fa-chart-line text-white"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Visits This Month</span>
                            <span class="info-box-number h3 mb-0"><?php echo number_format($stats_total_this_month); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-warning-gradient">
                        <span class="info-box-icon"><i class="fas fa-user-friends text-white"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Unique Visitors (Month)</span>
                            <span class="info-box-number h3 mb-0"><?php echo number_format($stats_unique_this_month); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="info-box metric-card bg-danger-gradient">
                        <span class="info-box-icon"><i class="fas fa-calendar-day text-white"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text text-uppercase text-xs font-weight-bold">Visits Today</span>
                            <span class="info-box-number h3 mb-0"><?php echo number_format($stats_today); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content row -->
            <div class="row">
                <!-- Left column: Top 10 Pages Table -->
                <div class="col-lg-6 col-md-12">
                    <div class="card dashboard-card-custom h-100 mb-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold text-dark"><i class="fas fa-trophy text-warning mr-1"></i> Top 10 Visited Pages (This Month)</h3>
                        </div>
                        <div class="card-body p-0 table-responsive" style="max-height: 450px; overflow-y: auto;">
                            <table class="table table-striped table-hover table-bordered mb-0">
                                <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                                    <tr>
                                        <th class="text-center" style="width: 50px;">#</th>
                                        <th>URL Route</th>
                                        <th class="text-center" style="width: 130px;">Visit Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($top_pages)): ?>
                                        <?php $i = 1; foreach ($top_pages as $page): ?>
                                            <tr>
                                                <td class="text-center font-weight-bold"><?php echo $i++; ?></td>
                                                <td>
                                                    <a href="<?php echo esc($page['url']); ?>" target="_blank" class="text-primary text-truncate d-inline-block" style="max-width: 320px;" title="<?php echo esc($page['url']); ?>">
                                                        <?php echo esc($page['url']); ?>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-primary px-3 py-2 font-weight-bold" style="border-radius: 20px; font-size: 0.85rem;">
                                                        <?php echo number_format($page['visit_count']); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">No visit logs recorded this month.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right column: Pie Graph for Main Pages -->
                <div class="col-lg-6 col-md-12">
                    <div class="card dashboard-card-custom h-100 mb-4">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold text-dark"><i class="fas fa-chart-pie text-success mr-1"></i> Main Pages Distribution (This Month)</h3>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center" style="min-height: 350px;">
                            <?php if (!empty($pie_values)): ?>
                                <div style="width: 100%; height: 300px; position: relative;">
                                    <canvas id="mainPagesPieChart"></canvas>
                                </div>
                            <?php else: ?>
                                <div class="text-center text-muted my-5">
                                    <i class="fas fa-chart-pie fa-3x mb-3 text-light"></i>
                                    <p>No main pages visits logged this month.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php if (!empty($pie_values)): ?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var ctx = document.getElementById('mainPagesPieChart').getContext('2d');
        
        var pieLabels = <?php echo json_encode($pie_labels); ?>;
        var pieValues = <?php echo json_encode($pie_values); ?>;
        
        // Beautiful vibrant color palette for modern styling
        var colors = [
            '#4e73df', // Primary blue
            '#1cc88a', // Success green
            '#36b9cc', // Info cyan
            '#f6c23e', // Warning yellow
            '#e74a3b', // Danger red
            '#6f42c1', // Purple
            '#fd7e14', // Orange
            '#20c997', // Teal
            '#e83e8c', // Pink
            '#858796', // Slate gray
            '#5a5c69'  // Dark gray
        ];

        var mainPagesPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    data: pieValues,
                    backgroundColor: colors.slice(0, pieLabels.length),
                    borderWidth: 1,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 15,
                        fontSize: 12,
                        padding: 15
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var dataset = data.datasets[tooltipItem.datasetIndex];
                            var total = dataset.data.reduce(function(previousValue, currentValue) {
                                return previousValue + currentValue;
                            });
                            var currentValue = dataset.data[tooltipItem.index];
                            var percentage = Math.round((currentValue / total) * 100);
                            return data.labels[tooltipItem.index] + ': ' + currentValue.toLocaleString() + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        });
    });
</script>
<?php endif; ?>
<?php echo $this->endSection() ?>
