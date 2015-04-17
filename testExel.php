<?php 
require_once('autoload.php');
require_once ('models/words.php');
error_reporting(E_ALL);
// Create new PHPExcel object

$objPHPExcel = new PHPExcel();

// Set properties

$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

$newWords = new ModelWords;
$data = $newWords->getAllWords();
  $activeSheet = $objPHPExcel->getActiveSheet();
  $activeSheet->SetCellValue('A1', 'ID');
  $activeSheet->SetCellValue('B1', 'WORD');
  $activeSheet->SetCellValue('C1', 'TRANSLATE');
foreach($data as $row)
{
  $activeSheet->SetCellValue('A2', 'hello');
  $activeSheet->SetCellValue('B2', 'some description');
  $activeSheet->SetCellValue('C2', 'привет');
}


// Add some data
/*
$activeSheet = $objPHPExcel->getActiveSheet();
  $activeSheet->SetCellValue('A1', 'WORD');
  $activeSheet->SetCellValue('B1', 'DESCRIPTION');
  $activeSheet->SetCellValue('C1', 'TRANSLATE');
  $activeSheet->SetCellValue('A2', 'test');
  $activeSheet->SetCellValue('B2', '');
  $activeSheet->SetCellValue('C2', 'translated test');
  $activeSheet->SetCellValue('A3', 'cat');
  $activeSheet->SetCellValue('B3', '');
  $activeSheet->SetCellValue('C3', 'translated cat');

*/
//Применение стиля 
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FF0000')
        )
    )
);


// Rename sheet

$objPHPExcel->getActiveSheet()->setTitle('Simple');

		
// Save Excel 2007 file

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="file.xlsx"');

// Write file to the browser
$objWriter->save('php://output');

// Echo done
