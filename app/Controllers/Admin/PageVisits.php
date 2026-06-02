<?php

namespace App\Controllers\Admin;

use App\Models\PageVisitModel;

class PageVisits extends AdminController
{
    protected $visitModel;

    public function __construct()
    {
        $this->visitModel = new PageVisitModel();
    }

    public function index(){
        $firstDayOfMonth = date('Y-m-01 00:00:00');

        $totalVisitsAllTime = $this->visitModel->countAllResults();
        $totalVisitsThisMonth = $this->visitModel->where('created_at >=', $firstDayOfMonth)->countAllResults();

        $uniqueResult = $this->visitModel->select('COUNT(DISTINCT ip_address) as total')
                                          ->where('created_at >=', $firstDayOfMonth)
                                          ->first();
        $uniqueVisitorsThisMonth = $uniqueResult['total'] ?? 0;

        $visitsToday = $this->visitModel->where('created_at >=', date('Y-m-d 00:00:00'))->countAllResults();

        // Top 10 pages this month
        $topPagesThisMonth = $this->visitModel->select('url, COUNT(id) as visit_count')
                                             ->where('created_at >=', $firstDayOfMonth)
                                             ->groupBy('url')
                                             ->orderBy('visit_count', 'DESC')
                                             ->limit(10)
                                             ->findAll();

        // Main pages classification
        $mainPagesMap = [
            ""                                            => "Home",
            "about-us"                                    => "About Us",
            "our-solutions"                               => "Our Solutions",
            "our-solutions/for-hcp"                       => "Solutions for HCP",
            "our-solutions/for-pharmaceutical-companies"  => "Solutions for Pharma",
            "our-solutions/for-healthcare-institutions"   => "Solutions for Healthcare Institutions",
            "our-leaders"                                 => "Our Leaders",
            "contact-us"                                  => "Contact Us",
            "join-us"                                     => "Join Us",
            "news-updates"                                => "News & Updates",
            "mims-privacy-policy"                         => "Privacy Policy"
        ];

        $urlGroups = $this->visitModel->select('url, COUNT(id) as visit_count')
                                      ->where('created_at >=', $firstDayOfMonth)
                                      ->groupBy('url')
                                      ->findAll();

        $mainPagesStats = [];
        foreach ($mainPagesMap as $name) {
            $mainPagesStats[$name] = 0;
        }

        $baseUrl = base_url();
        if (substr($baseUrl, -1) !== '/') {
            $baseUrl .= '/';
        }

        foreach ($urlGroups as $group) {
            $url = $group['url'];
            $count = (int)$group['visit_count'];

            $relativeRoute = '';
            if (str_starts_with($url, $baseUrl)) {
                $relativeRoute = substr($url, strlen($baseUrl));
            } else {
                $relativeRoute = ltrim(parse_url($url, PHP_URL_PATH) ?? '', '/');
            }
            $relativeRoute = rtrim($relativeRoute, '/');

            if (isset($mainPagesMap[$relativeRoute])) {
                $displayName = $mainPagesMap[$relativeRoute];
                $mainPagesStats[$displayName] += $count;
            }
        }

        $pieLabels = [];
        $pieValues = [];
        foreach ($mainPagesStats as $name => $count) {
            if ($count > 0) {
                $pieLabels[] = $name;
                $pieValues[] = $count;
            }
        }

        $data = array_merge($this->data, [
            'title'                      => 'Page Visits Dashboard',
            'active_tab'                 => 'page_visits',
            'stats_total_all_time'       => $totalVisitsAllTime,
            'stats_total_this_month'     => $totalVisitsThisMonth,
            'stats_unique_this_month'    => $uniqueVisitorsThisMonth,
            'stats_today'                => $visitsToday,
            'top_pages'                  => $topPagesThisMonth,
            'pie_labels'                 => $pieLabels,
            'pie_values'                 => $pieValues
        ]);

        return view('admin/page_visits/index', $data);
    }

    public function logs(){
        // Get initial stats (unfiltered) just like before for the logs page
        $totalVisits = $this->visitModel->countAllResults();

        $uniqueResult = $this->visitModel->select('COUNT(DISTINCT ip_address) as total')->first();
        $uniqueVisitors = $uniqueResult['total'] ?? 0;

        $visitsToday = $this->visitModel->where('created_at >=', date('Y-m-d 00:00:00'))->countAllResults();

        $topPageResult = $this->visitModel->select('url, COUNT(id) as visit_count')
                                          ->groupBy('url')
                                          ->orderBy('visit_count', 'DESC')
                                          ->limit(1)
                                          ->first();
        $topPage = $topPageResult['url'] ?? 'N/A';
        $topPageCount = $topPageResult['visit_count'] ?? 0;

        $data = array_merge($this->data, [
            'title'            => 'Page Visit Logs',
            'active_tab'       => 'page_visits',
            'stats_total'      => $totalVisits,
            'stats_unique'     => $uniqueVisitors,
            'stats_today'      => $visitsToday,
            'stats_top_page'   => $topPage,
            'stats_top_count'  => $topPageCount
        ]);

        return view('admin/page_visits/logs', $data);
    }

    public function delete($id = ''){
        if(!empty($id)){
            $this->visitModel->delete($id);
            $this->session->setFlashData('success', 'Visit log was successfully deleted.');
            return redirect()->to('admin/page-visits/logs');
        }else{
            return redirect()->to('admin/page-visits/logs');
        }
    }

    private function applyFilters($query)
    {
        $search = $this->request->getPost('search');
        $searchValue = $search['value'] ?? '';

        if (!empty($searchValue)) {
            $query = $query->groupStart()
                ->like('ip_address', $searchValue)
                ->orLike('url', $searchValue)
                ->orLike('user_agent', $searchValue)
                ->groupEnd();
        }

        $filterIp = $this->request->getPost('filter_ip');
        if (!empty($filterIp)) {
            $query = $query->like('ip_address', $filterIp);
        }

        $filterUrl = $this->request->getPost('filter_url');
        if (!empty($filterUrl)) {
            $query = $query->like('url', $filterUrl);
        }

        $filterStartDate = $this->request->getPost('filter_start_date');
        if (!empty($filterStartDate)) {
            $query = $query->where('created_at >=', $filterStartDate . ' 00:00:00');
        }

        $filterEndDate = $this->request->getPost('filter_end_date');
        if (!empty($filterEndDate)) {
            $query = $query->where('created_at <=', $filterEndDate . ' 23:59:59');
        }

        return $query;
    }

    public function tableListing(){
        $input = $_POST;
        $limit = $input['length'] ?? 10;
        $start = $input['start'] ?? 0;

        // Base/Filtered records
        $query = $this->visitModel;
        $query = $this->applyFilters($query);
        
        $totalRecords = $this->visitModel->countAllResults(); // Unfiltered total
        
        // Clone/Re-apply for counting filtered results
        $filteredQuery = $this->visitModel;
        $filteredQuery = $this->applyFilters($filteredQuery);
        $recordsFiltered = $filteredQuery->countAllResults();

        // Fetch records
        $recordsQuery = $this->visitModel;
        $recordsQuery = $this->applyFilters($recordsQuery);
        $records = $recordsQuery->orderBy('id', 'DESC')->findAll($limit, $start);

        // Stats calculations under current filters
        // 1. Total filtered visits is simply $recordsFiltered
        $statsTotal = $recordsFiltered;

        // 2. Unique visitors under filter
        $uniqueQuery = $this->visitModel;
        $uniqueQuery = $this->applyFilters($uniqueQuery);
        $uniqueResult = $uniqueQuery->select('COUNT(DISTINCT ip_address) as total')->first();
        $statsUnique = $uniqueResult['total'] ?? 0;

        // 3. Visits today under filter
        $todayQuery = $this->visitModel;
        $todayQuery = $this->applyFilters($todayQuery);
        $todayQuery = $todayQuery->where('created_at >=', date('Y-m-d 00:00:00'));
        $statsToday = $todayQuery->countAllResults();

        // 4. Top visited page under filter
        $topPageQuery = $this->visitModel;
        $topPageQuery = $this->applyFilters($topPageQuery);
        $topPageResult = $topPageQuery->select('url, COUNT(id) as visit_count')
                                      ->groupBy('url')
                                      ->orderBy('visit_count', 'DESC')
                                      ->limit(1)
                                      ->first();
        $statsTopPage = $topPageResult['url'] ?? 'N/A';
        $statsTopPageCount = $topPageResult['visit_count'] ?? 0;

        $data = [];
        foreach ($records as $row) {
            $action = '<a href="'. base_url('admin/page-visits/delete/'.$row['id']) .'" class="btn btn-sm btn-danger btn-delete-item" onclick="return confirm(\'Are you sure you want to delete this visit log?\')"><i class="fa fa-trash"></i> Delete</a>';

            $data[] = [
                'id' => $row['id'],
                'ip_address' => $row['ip_address'],
                'url' => $row['url'],
                'referrer' => $row['referrer'] ?? 'Direct',
                'user_agent' => $row['user_agent'],
                'created_at' => formatted_date($row['created_at']),
                'action' => $action
            ];
        }

        $output = [
            'draw' => intval($input['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'stats' => [
                'total' => number_format($statsTotal),
                'unique' => number_format($statsUnique),
                'today' => number_format($statsToday),
                'top_page' => esc($statsTopPage),
                'top_page_count' => number_format($statsTopPageCount)
            ]
        ];

        return $this->response->setJSON($output);
    }
}
