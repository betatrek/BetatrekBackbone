<html>
<body>

<?php
include('../simplehtmldom_1_5/simple_html_dom.php');

$html = file_get_html('./page.html');
// get the table. Maybe there's just one, in which case just 'table' will do
$table = $html->find('#theTable');

// initialize empty array to store the data array from each row
$theData = array();

// loop over rows
foreach($table->find('tr') as $row) {

    // initialize array to store the cell data from each row
    $rowData = array();
    foreach($row->find('td.text') as $cell) {

        // push the cell's text to the array
        $rowData[] = $cell->innertext;
    }

    // push the row's data array to the 'big' array
    $theData[] = $rowData;
}
print_r($theData);
?>

</body>
</html>
