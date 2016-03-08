@extends('layouts.apptemplate')

@section('title')
    BRANCH
@endsection

@section('menu')
@include('layouts.menu')
@endsection

@section('content')
@include('layouts.validationAlert')
<div class="">

    <div class="table-responsive">
        <table id="jqGridHome" class="table "></table>
    </div>
      {!!
    GridRender::setGridId("jqGridHome")
      ->setGridAsPivot()
      ->setGridOption('url',URL::to('/dashboard'))
      ->setGridOption('editurl',URL::to('/branch/crud'))
      ->setGridOption('rowNum', 1000)
      ->setGridOption('rownumbers', true)
      ->setGridOption('autowidth', true)
      ->setGridOption('height', 500)
      ->setGridOption('caption','Home')
      ->setGridOption('viewrecords',false)
      ->setGridOption('pager', false)
      ->setGridEvent('loadComplete', 'homeGridComplete')
      ->addXDimension(array('label' => 'Branch Name', 'dataName'=>'branchName', 'sortable' => false, 'align' => 'left'
           ))

      ->addXDimension(array('label' => 'Region Name', 'dataName'=>'regName', 'sortable' => false, 'formatter' => 'linksToRegion', 'align' => 'left'))
      ->addAggregate(array('label' => 'Region Id', 'member'=>'regId', 'sortable' => false, 'aggregator' => 'sum', 'hidden' => true))
      ->addAggregate(array('label' => 'Branch Id', 'member'=>'branchId', 'sortable' => false, 'aggregator' => 'sum', 'hidden' => true, 'formatter' => 'linksToBranch'))
      ->addAggregate(array('label' => 'No Of Stations', 'member'=>'stations', 'aggregator' => 'sum', 'sortable' => false, 'formatter' => 'noOfStations'))
      ->addAggregate(array( 'label' => 'No Of Bays', 'member'=>'bay', 'aggregator' => 'sum','sortable' => false, 'formatter' => 'noOfBays'))
      ->addAggregate(array( 'label' => 'No Of Hosts', 'member'=>'host', 'aggregator' => 'sum','sortable' => false, 'formatter' => 'noOfHosts'))
      ->renderGrid();
    !!}
</div>
@stop
