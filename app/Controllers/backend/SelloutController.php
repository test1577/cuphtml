<?php

namespace App\Controllers\backend;

use URL,
    App,
    Hash,
    Auth,
    Excel,
    Input,
    Session,
    Request,
    Redirect,
    Validator;
use App\Controllers\backend\Controller;
use App\Model\backend\SelloutModel;
use App\Component\backend\SelloutComponent;

class SelloutController extends Controller {

  protected $page;

  public function __construct() {
    parent::__construct();
    $this->page = 'Sellout';
  }

  protected function index($name = '') {
    // $this->exchangeFileXLSX();
    // $this->readFileCSV();
    $data = $this->setDataPageView('view');
    if($name) {
      // print_r($name);
      // exit();
      $this->exchangeFileXLSX($name);
      $this->readFileCSV($name);
    }
    return view('backend/home', $data);
    // $this->readFileCSV();
  }

  protected function upload() {
    $destinationPath = storage_path() . '/uploads/excel';
    $image = Request::file('files')[0];
    $name = $image->getClientOriginalName();
    // print_r($name);
    // exit;
    // foreach ($images as $key => $image) {
      $image->move($destinationPath, $image->getClientOriginalName());
    // }
    // if(!$image->move($destinationPath, $image->getClientOriginalName())) {
    //   return $this->errors(['message' => 'Error saving the file.', 'code' => 400]);
    // }
    // return response()->json(['success' => true], 200);
    return redirect()->route('sellout/name', array('name' => $name));
  }

  private function exchangeFileXLSX($name = '') {
    $excel = App::make ('excel');
    $excel->load('storage/uploads/excel/'.$name, function ($reader) use ($name, &$csv){
      $reader->store('csv', storage_path('uploads/excel/'), false);
      // $csv = $reader->store('csv', true, true);
      // $csv = array_map('str_getcsv', file('../public/'.$csv['full'].''));
      // $rows = $this->exchangeRowSellout($csv);
      // $this->exportToXLS($rows, $filename);
    }, 'UTF-8');
  }

  private function readFileCSV($name = '') {
    $listNames = explode(".", $name);
    $excel = App::make ('excel');
    $excel->create($listNames[0].'_new', function($excel) use ($listNames){
      $excel->sheet('Sheetname', function($sheet) use ($listNames){
          $csv = array_map('str_getcsv', file('../storage/uploads/excel/'.$listNames[0].'.csv'));
          $result = $this->exchangeRowSellout($csv);
          $sheet->fromArray($result);
      });
    })->export('xls');
  }

  private function exchangeRowSellout($mainRows) {
    # คลังสินค้า
    # ประเภท
    # วันที่
    # เลขที่เอกสาร
    # รหัสสินค้า
    # ชื่อสินค้า
    # ลูกค้า
    # Serial No
    # ยี่ห้อ
    $title = null;
    $type = null;
    $date = null;
    $numberDoc = null;
    $vendor = null;
    $rowIndex = null;
    $temps = array();
    foreach ($mainRows as $row => $mainRow) {
      $rowIsNull = $mainRow == 'null';
      $hasTitle = !empty($mainRows[$row][0]) && $mainRows[$row][0]!==',","';
      $hasInvoice = !empty($mainRows[$row][1]);
      $hasProduct = empty($mainRows[$row][1]) && !empty($mainRows[$row][2]);
      if (!$rowIsNull) {
        if ($hasTitle) $title = $mainRows[$row][0];
        if ($hasInvoice) {
          $type = $mainRows[$row][1];
          $date = $mainRows[$row][2];
          $number_doc = $mainRows[$row][3];
          $vendor = $mainRows[$row][4];
        }
        if ($hasProduct) {
          // $tempMain = array(
          //   'inventory'=> $title,
          //   'type'=> $type,
          //   'date'=> $date,
          //   'number_doc'=> $number_doc,
          //   'product_code'=> $mainRows[$row][2],
          //   'product_name'=> $mainRows[$row][3],
          //   'vendor'=> $vendor,
          //   'serial'=> $mainRows[$row][5],
          //   'brand'=> $mainRows[$row][6]
          // );
            # คลังสินค้า
            # ประเภท
            # วันที่
            # เลขที่เอกสาร
            # รหัสสินค้า
            # ชื่อสินค้า
            # ลูกค้า
            # Serial No
            # ยี่ห้อ
            $tempMain = array(
              'คลังสินค้า'=> $title,
              'ประเภท'=> $type,
              'วันที่'=> $date,
              'เลขที่เอกสาร'=> $number_doc,
              'รหัสสินค้า'=> $mainRows[$row][2],
              'ชื่อสินค้า'=> $mainRows[$row][3],
              'ลูกค้า'=> $vendor,
              'Serial No'=> (int)str_replace(',','',$mainRows[$row][5]).'',
              'ยี่ห้อ'=> $mainRows[$row][6]
            );
          array_push($temps, $tempMain);
              // return;
        }
      }
    }
    return $temps;
  }

  protected function setDataPageView($subPage, $id = '') {
    $result = [
        'global' => $this->global,
        'page' => $this->page,
        'subPage' => $subPage,
        'title' => $this->page . $this->global['title'],
        'admin' => $this->admin,
        'data' => []
    ];
    if ($subPage === 'view') {
      $selectField = [
          'id',
          'email',
          'name',
          'status'
      ];
      $result['data']['rows'] = null;
    }
    return $result;
  }



}
