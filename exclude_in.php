    <?php
    $reg = get_page_by_path("agency-registration");
    $reg_id = $reg->ID;
    $reg_class = ".page-item-".$reg_id;

    $signin = get_page_by_path("agency-login");
    $signin_id = $signin->ID;
    $signin_class = ".page-item-".$signin_id;

    $reg_care = get_page_by_path("caregiver-registration");
    $reg_id_care = $reg_care->ID;
    $reg_class_care = ".page-item-".$reg_id_care;

    $signin_care = get_page_by_path("caregiver-login");
    $signin_care_id = $signin_care->ID;
    $signin_care_class = ".page-item-".$signin_care_id;

    $caregiver = get_page_by_path("caregivers");
    $caregiver_id = $caregiver->ID;
    $caregiver_class = ".page-item-".$caregiver_id;

 
    echo "<style>".$signin_class."{display:none !important}</style>";
    echo "<style>".$reg_class."{display:none !important}</style>";
    echo "<style>".$caregiver_class."{display:none !important}</style>";
    echo "<style>".$signin_care_class."{display:none !important}</style>";
    echo "<style>".$reg_class_care."{display:none !important}</style>";

?>