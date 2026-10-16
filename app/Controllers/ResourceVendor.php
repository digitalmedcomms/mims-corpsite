<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class ResourceVendor extends BaseController
{
    public function index()
    {
        $filePath = FCPATH . 'MIMS Vendor PO.pdf';

        if (!file_exists($filePath)) {
            $filePath = ROOTPATH . 'public' . DIRECTORY_SEPARATOR . 'MIMS Vendor PO.pdf';
        }

        if (!file_exists($filePath)) {
            $filePath = ROOTPATH . 'MIMS Vendor PO.pdf';
        }

        if (!file_exists($filePath)) {
            throw PageNotFoundException::forPageNotFound('MIMS Vendor PO file not found.');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="MIMS Vendor PO.pdf"')
            ->setHeader('Content-Length', (string) filesize($filePath))
            ->setBody(file_get_contents($filePath));
    }
}
