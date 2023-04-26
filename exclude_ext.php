<?php
    $profile_class = ".menu-item-".$items["Profile"];

    $dash_class = ".menu-item-".$items["Dashboard"];

    $caregivers_class = ".menu-item-".$items["Assigned Caregiver"];

    $report_class = ".menu-item-".$items["Report"];

    $shifts_class = ".menu-item-".$items["Shifts"];

    $caregiver_report = ".menu-item-".$items["Caregiver report"];

    $caregiver_apply = ".menu-item-".$items["Caregiver apply"];

    $caregiver_profile = ".menu-item-".$items["Caregiver profile"];

    $caregiver_dashboard = ".menu-item-".$items["Caregiver dashboard"];
    
  
    echo "<style>".$dash_class."{display:none !important}</style>";
    echo "<style>".$shifts_class."{display:none !important}</style>";
    echo "<style>".$report_class."{display:none !important}</style>";
    echo "<style>".$caregivers_class."{display:none !important}</style>";
    echo "<style>".$profile_class."{display:none !important}</style>";

    echo "<style>".$caregiver_report."{display:none !important}</style>";
    echo "<style>".$caregiver_apply."{display:none !important}</style>";
    echo "<style>".$caregiver_profile."{display:none !important}</style>";
    echo "<style>".$caregiver_dashboard."{display:none !important}</style>";

  ?>

