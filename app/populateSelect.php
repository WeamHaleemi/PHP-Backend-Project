<?php
include 'getItems.php';
if (isset($_GET['value'])) {
    $items = getMenuItems($_GET['value']);
    if (count($items) > 0)
        foreach ($items as $item)
            echo '<option value="' . $item->idItem . '">' . $item->Item_name . '</option>';
    else
        echo '<option value="0">Select Meal</option>';
}