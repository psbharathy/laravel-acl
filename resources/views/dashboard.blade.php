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
      ->setGridOption('url',URL::to('/dashboard'))
      ->setGridOption('editurl',URL::to('/branch/crud'))
      ->setGridOption('rowNum', 1000)
      ->setGridOption('rownumbers', true)
      ->setGridOption('autowidth', true)
      ->setGridOption('height', 400)
      ->setGridOption('caption','Home')
      ->setGridOption('viewrecords',false)
      ->setGridOption('pager',false)
      ->setGridOption('cmTemplate', array('resizable' => false))
      ->setFileProperty('FileName', 'Branches')
      ->addColumn(array('index' => 'branchId', 'hidden' => true, 'editable' => true,'key' => true))
      ->addColumn(array('label' => 'Branch Name', 'index'=>'branchName', 'edittype' => 'text', 'align' => 'left',
              'editable' => true, 'sortable' => false, 'editrules' => array('required' => true),
             'formatter' => 'showlink', 'search' => false,
             'formatoptions' => array('baseLinkUrl'=>'/station', 'idName' => 'branch')))
      ->addColumn(array('index' => 'regId', 'hidden' => true, 'editable' => true, 'viewable' => false, 'editrules' => array('edithidden' => true)))
      ->addColumn(array('label' => 'Region Name', 'index'=>'regName' , 'edittype' => 'text', 'align' => 'left',
              'editable' => true, 'sortable' => false,'editrules' => array('required' => true),
               'formatter' => 'addHomeRegionLink', 'search' => false
             ))
        ->addColumn(array('label' => 'No Of Stations', 'index'=>'stations', 'sortable' => false,  'editable' => false,
          'search' => false, 'align' => 'right'))
     ->addColumn(array( 'label' => 'No Of Bays', 'index'=>'bay', 'sortable' => false,  'editable' => false,
          'search' => false, 'align' => 'right'))
      ->addColumn(array( 'label' => 'No Of Hosts', 'index'=>'host' , 'sortable' => false, 'editable' => false,
          'search' => false, 'align' => 'right'))
      ->renderGrid();
    !!}
</div>
@stop
