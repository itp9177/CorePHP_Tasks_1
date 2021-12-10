<?php
namespace App\Service;

use database\DbConnection as db;
use App\Controller\ProviderController;

class QueryFilter
{
    private static  $service;
    public static function get()
    {
        if (self::$service == null) {
            self::$service = new QueryFilter();
        }
        return self::$service;
    }

    protected function getSearchQuery($str)
    {
        parse_str($str, $output);
        $baseQuery = "SELECT Emails.id,Emails.Email,Providers.Name,Emails.Created From Emails,Providers";
        $baseQuery = $this->searchQuery($baseQuery, $output);
        $baseQuery = $this->filterQuery($baseQuery, $output);
        $baseQuery = $this->SortQuery($baseQuery, $output);

        return $baseQuery;
    }

    private function searchQuery($baseQuery, $output)
    {
        if ($output['search']) {
            $request = filter_input_array($output, FILTER_SANITIZE_STRING);
            $keyword = $output['search'];
            $keyword=$request['search'];
            return $baseQuery . " where (Emails.Email LIKE '%$keyword%' ) " . " AND Emails.providerID=Providers.id ";
        }
        return "SELECT Emails.id,Emails.Email,Providers.Name,Emails.Created From Emails,Providers where Emails.providerID=Providers.id";
    }

    private function filterQuery($baseQuery, $output)
    {
        if ($output['filter']) {
            $baseQuery = $baseQuery . " AND ( ";
            $filters = $output['filter'];
            $count = count($filters);
            foreach ($filters as $filter => $data) {
                if(ProviderController::get()->checkProvider($filter))
                $baseQuery = $baseQuery . " Providers.Name='" . $filter . "' ";
                if ($count > 1) {
                    $baseQuery = $baseQuery . " OR ";
                }
                $count = $count - 1;
            }
            $baseQuery = $baseQuery . " ) ";
            return $baseQuery;
        }
        return $baseQuery;
    }

    private function sortQuery($baseQuery, $output)
    {
        if ($output['sort']) {
            $sort = $output['sort'];
            if ($sort == 'Date')
                return $baseQuery . ' ORDER BY Created';
            if ($sort == 'Email')
                return $baseQuery . ' ORDER BY Email';
        }
        return $baseQuery . ' ORDER BY Created';
    }
    public function filterSearch($str)
    {
        $sql = $this->getSearchQuery($str);
        return [db::getConnection()->query($sql), $sql];
    }
}
