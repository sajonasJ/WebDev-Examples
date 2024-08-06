<?php
/* Functions for PM database example. */

/* Load sample data, an array of associative arrays. */
include "pms.php";

/* Search sample data for $name or $year or $state from form. */
function search($name, $year, $state) {
    global $pms;
    $results = $pms;

    // Filter $pms by $name
    if (!empty($name)) {
        $filtered = array();
        foreach ($results as $pm) {
            if (stripos($pm['name'], $name) !== FALSE) {
                $filtered[] = $pm;
            }
        }
        $results = $filtered;
    }

    // Filter $pms by $year
	if (!empty($year)) {
        $filtered = array();
        foreach ($results as $pm) {
            if (strpos($pm['from'], $year) !== FALSE || 
                strpos($pm['to'], $year) !== FALSE) {
                $filtered[] = $pm;
            }
        }
        $results = $filtered;
    }

    // Filter $pms by $state
    if (!empty($state)) {
        $filtered = array();
        foreach ($results as $pm) {
            if (stripos($pm['state'], $state) !== FALSE) {
                $filtered[] = $pm;
            }
        }
        $results = $filtered;
    }

    return $results;
}

