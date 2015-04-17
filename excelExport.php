<?php 
require_once('autoload.php');
require_once ('models/words.php');
error_reporting(E_ALL);
//Set columns names
/*
switch($columnIndex)
{
  case 'word' : return "A"; break;
  case 'description': return "B"; break;
  case 'translate': return "C"; break;
}
*/

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$array = array(
array('word'=>'some word', 'descr'=>'some descriprion', 'trans'=>'some translate'),
array('word'=>'some word1', 'descr'=>'some descriprion1', 'trans'=>'some translate1'),
array('word'=>'some word2', 'descr'=>'some descriprion2', 'trans'=>'some translate2')
  );

$columnIndex = array(
'word'=>'A','descr'=>'B','trans'=>'C'
  );

$headers = array(
'word'=>'word', 'descr'=>'description', 'trans'=>'translation'
);

$excelOffset = 1;
$headerOffset = 1;

echo "<table>";
echo "<tr>";
foreach($headers as $key=>$header)
{
  $totalHeaderOffset = $excelOffset;
  echo "<td>".$columnIndex[$key].$totalHeaderOffset.$header."</td>";
}
 echo "</tr>"; 

foreach($array as $keyData=>$dataRow)
{
  echo "<tr>";

  foreach($columnIndex as $key=>$abc) 
  {
    $totalOffset = $excelOffset + $headerOffset + $keyData;
    echo "<td>".$abc.$totalOffset.$dataRow[$key]."</td>";
  }

  echo "</tr>";
}
echo "</table>";












/*


// Add data
$activeSheet = $objPHPExcel->getActiveSheet();
$activeSheet->SetCellValue(''.$columnsArray[0].'1', 'WORD');
$activeSheet->SetCellValue(''.$columnsArray[1].'1', 'TRANSLATE');

$activeSheet->SetCellValue('A2', 'green');
$activeSheet->SetCellValue('B2', 'зеленый');

$activeSheet->SetCellValue('A3', 'blue');
$activeSheet->SetCellValue('B3', 'голубой');

$activeSheet->SetCellValue('A4', 'pink');
$activeSheet->SetCellValue('B4', 'розовый');







// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('vocabulary');
		
// Save Excel 2007 file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="vocabulary.xlsx"');

// Write file to the browser
$objWriter->save('php://output');
*/