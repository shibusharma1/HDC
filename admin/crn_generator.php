<?php
function generateCRN() {
    $file = 'last_crn.txt';

    // Check if the file exists and read the last CRN from it
    if (file_exists($file)) {
        $lastCRN = file_get_contents($file);
        $lastCRN = intval($lastCRN);
    } else {
        // If the file does not exist, start from 1000
        $lastCRN = 6999;
    }

    // Generate the new CRN
    $newCRN = $lastCRN + 1;

    // Save the new CRN back to the file
    file_put_contents($file, $newCRN);

    return $newCRN;
}

