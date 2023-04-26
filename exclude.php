<?php
    $profile = get_page_by_path("profile");
    $profile_id = $profile->ID;

    $dashboard = get_page_by_path("dashboard");
    $dashboard_id = $dashboard->ID;

    $caregivers = get_page_by_path("caregivers");
    $caregivers_id = $caregivers->ID;

    $report = get_page_by_path("report");
    $report_id = $report->ID;

    $shifts = get_page_by_path("shifts");
    $shifts_id = $shifts->ID;
    
    wp_list_pages("exclude= $shifts_id, $profile_id, $dashboard_id, $caregivers_id, $report_id");
?>

