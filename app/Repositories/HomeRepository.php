<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Models\Region;
use App\Models\Station;
use App\Models\Bay;
use App\Models\Host;
use App\Models\User;
use DB;
use Carbon\Carbon;

class HomeRepository
{


    public function getDashboardCount(){

        $branches = Branch::select('BranchId','BranchName')
                ->where('status', 'A')->get();
        $regionData = array();
        $branchRegion = array();
        foreach ($branches as $branch) {
           $regionData['branchId'] = $branch->BranchId;
           $regionData['branchName'] = $branch->BranchName;
            // Find All Regions By Branch
            $regions = $this->findRegionByBranchAndStation($regionData['branchId']);
            //var_dump($regions);
            // Loop All Branch


            unset($regionData['regions']);
            foreach ($regions as $region)  {
                    // $regionData['regions'][$region->RegionName] = $region;
                    // Find All Station Count By Region
                    $stationCount = $this->findStationByRegionId($region->RegionId);
                    // Find All Bay Count By Region
                    $bayCount = $this->findBaysByRegionId($region->RegionId);
                    // Find All Host Count By Region
                $hostCount= $this->findHostsByRegionId($region->RegionId);
                $regionData['regions'][$region->RegionName] = array('regId' => $region->RegionId, 'stations'=>$stationCount,
                    'Bay' => $bayCount,
                    'HostCount' =>$hostCount);
            }
            //add Current Region data
            $branchRegion[] = $regionData;
            unset($regionData[$region->RegionId]);
        }
        $collection = collect($branchRegion);
        $regionData = $collection->groupBy('branchName');
        $branchList = $regionData->toArray();
        //dd($branchList);
        $statsData = array();
        foreach ($branchList as $branch) {
            foreach($branch as $regions) {

                if(isset($regions['regions']))
                foreach ($regions['regions'] as $region => $counts) {
                    $statsData[] = array (
                        'branchId' => $regions['branchId'],
                        'branchName' => $regions['branchName'],
                        'regName' =>$region,
                        'regId' => $counts['regId'],
                        'stations' => $counts['stations'],
                        'bay' => $counts['Bay'],
                        'host'=>$counts['HostCount']
                    );
                }
            }
        }
        return $statsData;
    }

    public function findRegionByBranchAndStation($branchId)
    {
        return DB::table('Station')
            ->select('Region.RegionId', 'Region.RegionName')
            ->join('Branch', 'Station.BranchId', '=', 'Branch.BranchId')
            ->join('Region', 'Station.RegionId', '=', 'Region.RegionId')
            ->where('Station.BranchId', $branchId)
            ->where('Station.status', 'A')
            ->groupBy('Region.RegionId')
            ->get();
    }

    public function findStationByRegionId($RegionId)
    {
         $stations = DB::table('Region')
                ->select('Station.StationName')
                ->join('Station', 'Region.RegionId', '=', 'Station.RegionId')
                ->join('Branch', 'Station.BranchId', '=', 'Branch.BranchId')
                ->where('Region.RegionId', $RegionId)
                ->where('Region.status', 'A')
                ->where('Station.status', 'A')->count();
        return $stations;
    }

    public function findBaysByRegionId($RegionId) {
        $bays =  DB::table('Bay')
                        ->join('Station', 'Bay.StationId', '=', 'Station.StationId')
                        ->join('Region', 'Station.RegionId', '=', 'Region.RegionId')
                        ->join('Branch', 'Station.BranchId', '=', 'Branch.BranchId')
                        ->where('Station.RegionId', $RegionId)
                        ->where('Station.status', 'A')
                        ->where('Region.status', 'A')
                        ->where('Bay.status', 'A')
                        ->count();
        return $bays;
    }

    public function findHostsByRegionId($RegionId) {
         $hosts =  DB::table('Host')
                            ->join('Bay', 'Host.BayId', '=', 'Bay.BayId')
                            ->join('Station', 'Bay.StationId', '=', 'Station.StationId')
                            ->join('Region', 'Station.RegionId', '=', 'Region.RegionId')
                            ->join('Branch', 'Station.BranchId', '=', 'Branch.BranchId')
                            ->where('Station.RegionId', $RegionId)
                            ->where('Region.status', 'A')
                            ->where('Station.status', 'A')
                            ->where('Bay.status', 'A')
                            ->where('Host.status', 'A')
                            ->count();
        return $hosts;
    }

}
