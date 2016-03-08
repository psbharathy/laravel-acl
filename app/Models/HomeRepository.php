<?php
use Illuminate\Database\DatabaseManager as DatabaseManager; 
use Mgallegos\LaravelJqgrid\Repositories\EloquentRepositoryAbstract; 
class HomeRepository extends EloquentRepositoryAbstract
{ 
    public function __construct(DatabaseManager $DatabaseManager)
    {
        $this->Database = $DatabaseManager->table('Station')
                            ->select('Branch.BranchId', 'Branch.BranchName', 'Region.RegionId', 'Region.RegionId')
                            ->join('Bay','Bay.StationId', '=', 'Station.StationId')
                            ->join('Host','Host.BayId', '=', 'Bay.BayId')
                            ->rightjoin('Region','Station.RegionId', '=', 'Region.RegionId')
                            ->rightjoin('Branch','Station.BranchId', '=', 'Branch.BranchId')
                            ->where('Branch.Status', '=', $this->status['Active']);
        $this->visibleColumns = array('Station.StationId','Region.RegionId','Region.RegionName',
                            'Bay.BayId', 'Host.HostId', 'Branch.BranchId', 'Branch.BranchName');
        $this->orderBy = array(array('Branch.BranchId', 'asc'));
    }
}
