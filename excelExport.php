<?php 
require_once('autoload.php');

$words = new Models\Words();

//require_once ('models/words.php');
error_reporting(E_ALL);

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$array = $words->getAllWords();

//Set columns names
$columnIndex = array(
'word'=>'A','descr'=>'B','trans'=>'C'
  );

$headers = array(
'word'=>'word', 'descr'=>'description', 'trans'=>'translation'
);

$excelOffset = 1;
$headerOffset = 1;
$activeSheet = $objPHPExcel->getActiveSheet();

$headersStyle = array(
  'font'  => array(
    'bold'  => true,
    'color' => array('rgb' => 'D5DDE5'),
    'size'  => 15,
    'name'  => 'Roboto'
  ),
  'fill' => array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array('rgb'=>'1B1E24'),
  ),
  'alignment' => array(
  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
  )
);

$styleArray = array(
  'font'  => array(
    'color' => array('rgb' => '746B85'),
    'size'  => 13,
    'name'  => 'Verdana'
  ),
  'fill' => array(
    'type' => PHPExcel_Style_Fill::FILL_SOLID,
    'color' => array('rgb'=>'EBEBEB'),
  ),
  'borders' => array(
    'allborders' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN,
      'color' => array('argb' => 'C1C3D1')
    )
  ),
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
  )
);

$activeSheet->getDefaultRowDimension()->setRowHeight(25);
$activeSheet->getDefaultColumnDimension()->setWidth(35);
$activeSheet->getRowDimension(1)->setRowHeight(25); 
foreach($headers as $key=>$header)
{
  $totalHeaderOffset = $excelOffset;
  $excelCoordinate = $columnIndex[$key].$totalHeaderOffset;
  $value = $header;
  $activeSheet->SetCellValue($excelCoordinate, $value);
  $activeSheet->getStyle($excelCoordinate)->applyFromArray($headersStyle);
}

foreach($array as $keyData=>$dataRow)
{
  foreach($columnIndex as $key=>$abc) 
  {
    $totalOffset = $excelOffset + $headerOffset + $keyData;
    $excelCoordinate = $abc.$totalOffset;
    $value = $dataRow[$key];
    $activeSheet->SetCellValue($excelCoordinate, $value);
    $activeSheet->getStyle($excelCoordinate)->applyFromArray($styleArray);
    $activeSheet->getStyle($excelCoordinate)->getAlignment()->setWrapText(true);
  }
}

// Rename sheet
$activeSheet->setTitle('vocabulary');
// Save Excel 2007 file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="vocabulary.xlsx"');

// Write file to the browser
$objWriter->save('php://output');