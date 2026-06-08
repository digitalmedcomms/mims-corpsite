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
        $db = \Config\Database::connect();

        $totalVisitsAllTime = $this->applyBrowserFilter($db->table('page_visits'))->countAllResults();
        $totalVisitsThisMonth = $this->applyBrowserFilter($db->table('page_visits'))->where('created_at >=', $firstDayOfMonth)->countAllResults();

        $uniqueResult = $this->applyBrowserFilter($db->table('page_visits'))
                           ->select('COUNT(DISTINCT ip_address) as total')
                           ->where('created_at >=', $firstDayOfMonth)
                           ->get()->getRowArray();
        $uniqueVisitorsThisMonth = $uniqueResult['total'] ?? 0;

        $visitsToday = $this->applyBrowserFilter($db->table('page_visits'))->where('created_at >=', date('Y-m-d 00:00:00'))->countAllResults();

        // Top 10 pages this month
        $topPagesThisMonth = $this->applyBrowserFilter($db->table('page_visits'))
                               ->select('url, COUNT(id) as visit_count')
                               ->where('created_at >=', $firstDayOfMonth)
                               ->groupBy('url')
                               ->orderBy('visit_count', 'DESC')
                               ->limit(10)
                               ->get()->getResultArray();

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

        $urlGroups = $this->applyBrowserFilter($db->table('page_visits'))
                        ->select('url, COUNT(id) as visit_count')
                        ->where('created_at >=', $firstDayOfMonth)
                        ->groupBy('url')
                        ->get()->getResultArray();

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

            // Strip index.php prefix if present
            if (str_starts_with($relativeRoute, 'index.php/')) {
                $relativeRoute = substr($relativeRoute, 10);
            } elseif ($relativeRoute === 'index.php') {
                $relativeRoute = '';
            }

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
        $db = \Config\Database::connect();

        $totalVisits = $this->applyBrowserFilter($db->table('page_visits'))->countAllResults();

        $uniqueResult = $this->applyBrowserFilter($db->table('page_visits'))->select('COUNT(DISTINCT ip_address) as total')->get()->getRowArray();
        $uniqueVisitors = $uniqueResult['total'] ?? 0;

        $visitsToday = $this->applyBrowserFilter($db->table('page_visits'))->where('created_at >=', date('Y-m-d 00:00:00'))->countAllResults();

        $topPageResult = $this->applyBrowserFilter($db->table('page_visits'))->select('url, COUNT(id) as visit_count')
                                          ->groupBy('url')
                                          ->orderBy('visit_count', 'DESC')
                                          ->limit(1)
                                          ->get()->getRowArray();
        $topPage = $topPageResult['url'] ?? 'N/A';
        $topPageCount = $topPageResult['visit_count'] ?? 0;

        // Top 10 pages all time
        $topPagesAllTime = $this->applyBrowserFilter($db->table('page_visits'))
                               ->select('url, COUNT(id) as visit_count')
                               ->groupBy('url')
                               ->orderBy('visit_count', 'DESC')
                               ->limit(10)
                               ->get()->getResultArray();

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

        $urlGroups = $this->applyBrowserFilter($db->table('page_visits'))
                        ->select('url, COUNT(id) as visit_count')
                        ->groupBy('url')
                        ->get()->getResultArray();

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

            // Strip index.php prefix if present
            if (str_starts_with($relativeRoute, 'index.php/')) {
                $relativeRoute = substr($relativeRoute, 10);
            } elseif ($relativeRoute === 'index.php') {
                $relativeRoute = '';
            }

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
            'title'            => 'Page Visit Logs',
            'active_tab'       => 'page_visits',
            'stats_total'      => $totalVisits,
            'stats_unique'     => $uniqueVisitors,
            'stats_today'      => $visitsToday,
            'stats_top_page'   => $topPage,
            'stats_top_count'  => $topPageCount,
            'top_pages'        => $topPagesAllTime,
            'pie_labels'       => $pieLabels,
            'pie_values'       => $pieValues
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

    private function applyBrowserFilter($builder)
    {
        $uaConfig = new \Config\UserAgents();

        // 1. Must NOT match any robot pattern
        $builder = $builder->groupStart();
        foreach ($uaConfig->robots as $robotKey => $robotVal) {
            $builder = $builder->notLike('user_agent', $robotKey);
        }
        $builder = $builder->groupEnd();

        // 2. Must match at least one browser pattern
        $builder = $builder->groupStart();
        $first = true;
        foreach ($uaConfig->browsers as $browserKey => $browserVal) {
            $cleanKey = preg_replace('/[^a-zA-Z0-9\s]/', '', $browserKey);
            if (empty($cleanKey)) {
                continue;
            }
            if ($first) {
                $builder = $builder->like('user_agent', $cleanKey);
                $first = false;
            } else {
                $builder = $builder->orLike('user_agent', $cleanKey);
            }
        }
        $builder = $builder->groupEnd();

        return $builder;
    }

    private function applyFilters($builder)
    {
        $search = $this->request->getPost('search');
        $searchValue = $search['value'] ?? '';

        if (!empty($searchValue)) {
            $builder = $builder->groupStart()
                ->like('ip_address', $searchValue)
                ->orLike('url', $searchValue)
                ->orLike('user_agent', $searchValue)
                ->groupEnd();
        }

        $filterIp = $this->request->getPost('filter_ip');
        if (!empty($filterIp)) {
            $builder = $builder->like('ip_address', $filterIp);
        }

        $filterUrl = $this->request->getPost('filter_url');
        if (!empty($filterUrl)) {
            $builder = $builder->like('url', $filterUrl);
        }

        $filterStartDate = $this->request->getPost('filter_start_date');
        if (!empty($filterStartDate)) {
            $builder = $builder->where('created_at >=', $filterStartDate . ' 00:00:00');
        }

        $filterEndDate = $this->request->getPost('filter_end_date');
        if (!empty($filterEndDate)) {
            $builder = $builder->where('created_at <=', $filterEndDate . ' 23:59:59');
        }

        return $builder;
    }

    public function tableListing(){
        $input = $_POST;
        $limit = $input['length'] ?? 10;
        $start = $input['start'] ?? 0;

        $db = \Config\Database::connect();

        // Base/Filtered records
        $totalRecords = $this->applyBrowserFilter($db->table('page_visits'))->countAllResults(); // Unfiltered total
        
        // Clone/Re-apply for counting filtered results
        $filteredQuery = $this->applyBrowserFilter($db->table('page_visits'));
        $filteredQuery = $this->applyFilters($filteredQuery);
        $recordsFiltered = $filteredQuery->countAllResults();

        // Fetch records
        $recordsQuery = $this->applyBrowserFilter($db->table('page_visits'));
        $recordsQuery = $this->applyFilters($recordsQuery);
        $records = $recordsQuery->orderBy('id', 'DESC')->limit($limit, $start)->get()->getResultArray();

        // Stats calculations under current filters
        // 1. Total filtered visits is simply $recordsFiltered
        $statsTotal = $recordsFiltered;

        // 2. Unique visitors under filter
        $uniqueQuery = $this->applyBrowserFilter($db->table('page_visits'));
        $uniqueQuery = $this->applyFilters($uniqueQuery);
        $uniqueResult = $uniqueQuery->select('COUNT(DISTINCT ip_address) as total')->get()->getRowArray();
        $statsUnique = $uniqueResult['total'] ?? 0;

        // 3. Visits today under filter
        $todayQuery = $this->applyBrowserFilter($db->table('page_visits'));
        $todayQuery = $this->applyFilters($todayQuery);
        $todayQuery = $todayQuery->where('created_at >=', date('Y-m-d 00:00:00'));
        $statsToday = $todayQuery->countAllResults();

        // 4. Top visited page under filter
        $topPageQuery = $this->applyBrowserFilter($db->table('page_visits'));
        $topPageQuery = $this->applyFilters($topPageQuery);
        $topPageResult = $topPageQuery->select('url, COUNT(id) as visit_count')
                                      ->groupBy('url')
                                      ->orderBy('visit_count', 'DESC')
                                      ->limit(1)
                                      ->get()->getRowArray();
        $statsTopPage = $topPageResult['url'] ?? 'N/A';
        $statsTopPageCount = $topPageResult['visit_count'] ?? 0;

        // 5. Top 10 pages under current filter
        $topPagesQuery = $this->applyBrowserFilter($db->table('page_visits'));
        $topPagesQuery = $this->applyFilters($topPagesQuery);
        $topPages = $topPagesQuery->select('url, COUNT(id) as visit_count')
                                  ->groupBy('url')
                                  ->orderBy('visit_count', 'DESC')
                                  ->limit(10)
                                  ->get()->getResultArray();

        // 6. Main page distribution under current filter
        $urlGroupsQuery = $this->applyBrowserFilter($db->table('page_visits'));
        $urlGroupsQuery = $this->applyFilters($urlGroupsQuery);
        $urlGroups = $urlGroupsQuery->select('url, COUNT(id) as visit_count')
                                    ->groupBy('url')
                                    ->get()->getResultArray();

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

            // Strip index.php prefix if present
            if (str_starts_with($relativeRoute, 'index.php/')) {
                $relativeRoute = substr($relativeRoute, 10);
            } elseif ($relativeRoute === 'index.php') {
                $relativeRoute = '';
            }

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
                'top_page_count' => number_format($statsTopPageCount),
                'top_pages' => $topPages,
                'pie_labels' => $pieLabels,
                'pie_values' => $pieValues
            ]
        ];

        return $this->response->setJSON($output);
    }
}
