<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\BranchRepositories;
use App\Repositories\HomeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Input;

class HomeController extends Controller
{
    /**
    * Instances of Admin Repository
    */
    protected $branchRepo;
    protected $homeRepo;

    /**
    * Access all methods and objects in Repository
    */

    public function __construct(BranchRepositories $branchRepo, HomeRepository $homeRepo)
    {

        $this->branchRepo = $branchRepo;
        $this->homeRepo = $homeRepo;
    }

    /*
     Getting Branch info and Returning view
    */
    public function getIndex()
    {

        return view('home',compact('branch'));
    }

    public function getStatisticData()
    {
        $branchList = $this->homeRepo->getDashboardCount();
        $branch = array('page' => 1,
                        'records' => count($branchList),
                        'rows' => $branchList,
                        'total' => 1
                    );
        return $branch;
        exit;
    }
}
