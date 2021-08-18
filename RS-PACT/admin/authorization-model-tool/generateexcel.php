<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
set_time_limit(120);
ini_set('memory_limit', '256M');

/** Include PHPExcel */
include('../../includes/configure.php');
require '../../includes/Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel(); // Create new PHPExcel object

if (isset($_POST['send'])) {
      
    
    $objWorkSheet1= $objPHPExcel->createSheet(0);
    $objWorkSheet1->setTitle('METADATA');
    $objWorkSheet1 ->setCellValue('A4', 'TEMPLATE NAME')
                    ->setCellValue('A5', 'TEMPLATE VERSION')
                    ->setCellValue('A6', 'DELIMITER')
                    ->setCellValue('A7', 'DOMIAN')
                    ->setCellValue('A8', 'SOURCE')
                    ->setCellValue('A9', 'LEGENDS')
                    ->setCellValue('B4', 'AUTHORIZATION MODEL')
                    ->setCellValue('B5', 'V1.1')
                    ->setCellValue('B6', '||')
                    ->setCellValue('B7', 'authorizationModel')
                    ->setCellValue('B8', 'internal')
                    ->setCellValue('B9', 'SYSTEM COLOUMNS')
                    ->setCellValue('B10', 'BASE DATA MODEL')
                    ->setCellValue('B11', 'VALIDATION MODEL')
                    ->setCellValue('B12', 'DISPLAY MODEL')
                    ->setCellValue('B13', 'MANDATORY')
                    ->setCellValue('D4', 'SHEET NO.')
                    ->setCellValue('D5', '1')
                    ->setCellValue('D6', '2')
                    ->setCellValue('D7', '3')
                    ->setCellValue('D8', '4')
                    ->setCellValue('D9', '5')
                    ->setCellValue('E4', 'PHYSICAL SHEET NAME')
                    ->setCellValue('E5', 'ROLES')
                    ->setCellValue('E6', 'USERS')
                    ->setCellValue('E7', 'BASE PERMISSIONS')
                    ->setCellValue('E8', 'EARC PERMISSIONS')
                    ->setCellValue('E9', 'LOCALE PERMISSIONS')
                    ->setCellValue('F4', 'PROCESS?')
                    ->setCellValue('F5', 'Yes')
                    ->setCellValue('F6', 'Yes')
                    ->setCellValue('F7', 'Yes')
                    ->setCellValue('F8', 'Yes')
                    ->setCellValue('F9', 'Yes');

    $from = "A4"; // or any value
    $to = "A9"; // or any value
    $objPHPExcel->getSheetByName('METADATA')->getStyle("$from:$to")->getFont()->setBold( true );

    $objWorkSheet1->getStyle("A4:B13")->applyFromArray(
    array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => '#DDDDDD')
            )
        )
    )
    );

    $objWorkSheet1->getStyle("D4:F9")->applyFromArray(
        array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '#DDDDDD')
                )
            )
        )
        );

    function cellColor($cells,$color){
        global $objPHPExcel;

        $objPHPExcel->getSheetByName('METADATA')->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                    'rgb' => $color
            )
        ));
    }

    cellColor('B9', '1F4E79');
    cellColor('B10', 'DEEBF7');
    cellColor('B11', 'FFF2CC');
    cellColor('B12', 'E2F0D9');
    cellColor('B13', 'DEEBF7');
    cellColor('D4', '1F4E79');
    cellColor('E4', '1F4E79');
    cellColor('F4', 'DEEBF7');
        
    $styleArray1 = array(
        'font'  => array(
            'color' => array('rgb' => 'FF0000')
        ));
    $objPHPExcel->getSheetByName('METADATA')->getStyle('B13')->applyFromArray($styleArray1);

    $styleArray2 = array(
        'font'  => array(
            'color' => array('rgb' => 'FFFFFF')
        ));
    $objPHPExcel->getSheetByName('METADATA')->getStyle('B9')->applyFromArray($styleArray2);
    $objPHPExcel->getSheetByName('METADATA')->getStyle('D4')->applyFromArray($styleArray2);
    $objPHPExcel->getSheetByName('METADATA')->getStyle('E4')->applyFromArray($styleArray2);

    //Setting font size of sheet to 12
    $styleArray3 = array(
        'font'  => array(
            'size' => 12
        ));
    $objPHPExcel->getSheetByName('METADATA')->getStyle("A4:E13")->applyFromArray($styleArray3);

    $gdImage = imagecreatefromjpeg( HTTP_SERVER.'assets/images/excelrslogo.jpg');
    $objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
    $objDrawing->setName('RS image');$objDrawing->setDescription('RS image');
    $objDrawing->setImageResource($gdImage);
    $objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
    $objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
    $objDrawing->setHeight(40);
    $objDrawing->setCoordinates('A1');
    $objDrawing->setWorksheet($objPHPExcel->getSheetByName('METADATA'));

    //Sets current sheets dimensions to auto size of column width
    foreach(range('A','Z') as $columnID) {
    $objPHPExcel->getSheetByName('METADATA')->getColumnDimension($columnID)
            ->setAutoSize(true);
    }
    $objPHPExcel->getSheetByName('METADATA')->getColumnDimension('C')
            ->setAutoSize(false);

    $objPHPExcel->getSheetByName('METADATA')->getColumnDimension($columnID)
            ->setWidth(12);
            
    $objWorkSheet2= $objPHPExcel->createSheet(1);
    $objWorkSheet2->setTitle('ROLES');
    $objWorkSheet2 ->setCellValue('A1', 'ACTION')
                    ->setCellValue('B1', 'ROLE')
                    ->setCellValue('C1', 'HELP TEXT');

    //Data Validation on Action Column 
    for($i=2;$i<=100;$i++){
    $objValidation = $objPHPExcel->getSheetByName('ROLES')->getCell('A'.$i)->getDataValidation();
    $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
    $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
    $objValidation->setAllowBlank(true);
    $objValidation->setShowInputMessage(true);
    $objValidation->setShowErrorMessage(true);
    $objValidation->setShowDropDown(true);
    $objValidation->setErrorTitle('This value doesn\'t\ match the data validation restrictions defined for this cell');
    $objValidation->setError('This value doesn\'t\ match the data validation restrictions defined for this cell');
    $objValidation->setFormula1('"Delete,Ignore"');
    }

    function cellColorRoles($cells,$color){
        global $objPHPExcel;

        $objPHPExcel->getSheetByName('ROLES')->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                    'rgb' => $color
            )
        ));
    }
    cellColorRoles('A1', '1F4E79');
    cellColorRoles('B1', 'DEEBF7');
    cellColorRoles('C1', 'E2F0D9');

    $objPHPExcel->getSheetByName('ROLES')->getStyle("A1:D500")->applyFromArray($styleArray3);
    $objPHPExcel->getSheetByName('ROLES')->getStyle('A1')->applyFromArray($styleArray2);
    $objPHPExcel->getSheetByName('ROLES')->getStyle('B1')->applyFromArray($styleArray1);

    //Sets current sheets dimensions to auto size of column width

    $objPHPExcel->getSheetByName('ROLES')->getColumnDimension('A')
                ->setWidth('10');
    $objPHPExcel->getSheetByName('ROLES')->getColumnDimension('B')
                ->setWidth('30');
    $objPHPExcel->getSheetByName('ROLES')->getColumnDimension('C')
                ->setWidth('40');      

            
    $objWorkSheet3= $objPHPExcel->createSheet(2);
    $objWorkSheet3->setTitle('USERS');
    $objWorkSheet3 ->setCellValue('A1', 'ACTION')
                    ->setCellValue('B1', 'LOGIN')
                    ->setCellValue('C1', 'ROLES')
                    ->setCellValue('D1', 'FIRST NAME')
                    ->setCellValue('E1', 'LAST NAME')
                    ->setCellValue('F1', 'EMAIL')
                    ->setCellValue('G1', 'DEFAULT ROLE')
                    ->setCellValue('H1', 'OWNERSHIP DATA')
                    ->setCellValue('I1', 'OWNERSHIP EDIT DATA')
                    ->setCellValue('J1', 'HELP TEXT');

                    //Data Validation on Action Column 
    for($i=2;$i<=100;$i++){
        $objValidation = $objPHPExcel->getSheetByName('USERS')->getCell('A'.$i)->getDataValidation();
        $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
        $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
        $objValidation->setAllowBlank(true);
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setError('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setFormula1('"Delete,Ignore"');
        }
    //set cell background colors
    function cellColorUsers($cells,$color){
        global $objPHPExcel;

        $objPHPExcel->getSheetByName('USERS')->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                    'rgb' => $color
            )
        ));
    }

    cellColorUsers('A1', '1F4E79');
    cellColorUsers('B1', 'DEEBF7');
    cellColorUsers('C1', 'DEEBF7');
    $j=1;
    foreach(range('D','J') as $columnID){
        cellColorUsers($columnID.$j, 'E2F0D9');
    }

    //setfontsize
    $objPHPExcel->getSheetByName('USERS')->getStyle("A1:J500")->applyFromArray($styleArray3);
    //setcfontcolors
    $objPHPExcel->getSheetByName('USERS')->getStyle('A1')->applyFromArray($styleArray2);
    $objPHPExcel->getSheetByName('USERS')->getStyle('B1')->applyFromArray($styleArray1);
    $objPHPExcel->getSheetByName('USERS')->getStyle('C1')->applyFromArray($styleArray1);

    //Sets current sheets dimensions to auto size of column width

    $objPHPExcel->getSheetByName('USERS')->getColumnDimension('A')
                ->setWidth('10');
    foreach(range('B','J') as $columnID){
                $objPHPExcel->getSheetByName('USERS')->getColumnDimension($columnID)
                ->setWidth('30');
    }
    $objPHPExcel->getSheetByName('USERS')->getColumnDimension('F')
                ->setWidth('50');

    $objWorkSheet4= $objPHPExcel->createSheet(3);
    $objWorkSheet4->setTitle('BASE PERMISSIONS');
    $objWorkSheet4 ->setCellValue('A1', 'ACTION')
                    ->setCellValue('B1', 'ROLE')
                    ->setCellValue('C1', 'DOMAIN')
                    ->setCellValue('D1', 'ENTITY')
                    ->setCellValue('E1', 'FOR CONTEXT TYPE')
                    ->setCellValue('F1', 'FOR CONTEXT NAME')
                    ->setCellValue('G1', 'BASE PERMISSION')
                    ->setCellValue('H1', 'ATTRIBUTES PERMISSION')
                    ->setCellValue('I1', 'RELATIONSHIPS PERMISSION')
                    ->setCellValue('J1', 'CONTEXTS PERMISSION')
                    ->setCellValue('K1', 'CONTEXT ATTRIBUTE PERMISSION')
                    ->setCellValue('L1', 'CONTEXT RELATIONSHIP PERMISSION');
    //Data Validation on Action Column 
    for($i=2;$i<=100;$i++){
        $objValidation = $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getCell('A'.$i)->getDataValidation();
        $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
        $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
        $objValidation->setAllowBlank(true);
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setError('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setFormula1('"Delete,Ignore"');
        }
    //set cell background colors
    function cellColorBasePermissions($cells,$color){
        global $objPHPExcel;

        $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                    'rgb' => $color
            )
        ));
    }

    cellColorBasePermissions('A1', '1F4E79');
    $j=1;
    foreach(range('B','L') as $columnID){
        cellColorBasePermissions($columnID.$j, 'DEEBF7');
    }

    //setfontsize
    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getStyle("A1:M2000")->applyFromArray($styleArray3);
    //setcfontcolors
    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getStyle('A1')->applyFromArray($styleArray2);

    //Sets current sheets dimensions to auto size of column width
    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getColumnDimension('A')
                ->setWidth('10');
    foreach(range('B','L') as $columnID){
                $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getColumnDimension($columnID)
                ->setAutoSize(true);
    }
    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getColumnDimension('B')
                ->setAutoSize(false);
    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->getColumnDimension('B')
                ->setWidth('15');


    $objWorkSheet5= $objPHPExcel->createSheet(4);
    $objWorkSheet5->setTitle('EARC PERMISSIONS');
    $objWorkSheet5 ->setCellValue('A1', 'ACTION')
                    ->setCellValue('B1', 'ROLE')
                    ->setCellValue('D1', 'RELATIONSHIP')
                    ->setCellValue('C1', 'ENTITY')
                    ->setCellValue('E1', 'FOR CONTEXT TYPE')
                    ->setCellValue('F1', 'FOR CONTEXT NAME')
                    ->setCellValue('G1', 'ATTRIBUTE')
                    ->setCellValue('H1', 'READ PERMISSION')
                    ->setCellValue('I1', 'WRITE PERMISSION')
                    ->setCellValue('J1', 'DELETE PERMISSION')
                    ->setCellValue('K1', 'DETERMINES ENTITY OWNERSHIP')
                    ->setCellValue('L1', 'OWNERSHIP EDIT PERMISSION');

                    //Data Validation on Action Column 
    for($i=2;$i<=100;$i++){
        $objValidation = $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getCell('A'.$i)->getDataValidation();
        $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
        $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
        $objValidation->setAllowBlank(true);
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setError('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setFormula1('"Delete,Ignore"');
        }

    //set cell background colors
    function cellColorEARCPermissions($cells,$color){
        global $objPHPExcel;

        $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                    'rgb' => $color
            )
        ));
    }
    cellColorEARCPermissions('A1', '1F4E79');
    $j=1;
    foreach(range('B','L') as $columnID){
        cellColorEARCPermissions($columnID.$j, 'DEEBF7');
    }

    //setfontsize
    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getStyle("A1:M2000")->applyFromArray($styleArray3);
    //setcfontcolors
    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getStyle('A1')->applyFromArray($styleArray2);

    //Sets current sheets dimensions to auto size of column width
    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getColumnDimension('A')
                ->setWidth('10');
    foreach(range('B','L') as $columnID){
                $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getColumnDimension($columnID)
                ->setAutoSize(true);
    }
    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getColumnDimension('B')
                ->setAutoSize(false);
    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->getColumnDimension('B')
                ->setWidth('15');

    $objWorkSheet6= $objPHPExcel->createSheet(5);
    $objWorkSheet6->setTitle('LOCALE PERMISSIONS');
    $objWorkSheet6 ->setCellValue('A1', 'ACTION')
                    ->setCellValue('B1', 'ROLE')
                    ->setCellValue('C1', 'LOCALE')
                    ->setCellValue('D1', 'READ PERMISSION')
                    ->setCellValue('E1', 'WRITE PERMISSION');

                    //Data Validation on Action Column 
    for($i=2;$i<=100;$i++){
        $objValidation = $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getCell('A'.$i)->getDataValidation();
        $objValidation->setType( PHPExcel_Cell_DataValidation::TYPE_LIST );
        $objValidation->setErrorStyle( PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
        $objValidation->setAllowBlank(true);
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setError('This value doesn\'t\ match the data validation restrictions defined for this cell');
        $objValidation->setFormula1('"Delete,Ignore"');
        }

    //set cell background colors
    function cellColorLocalePermissions($cells,$color){
        global $objPHPExcel;

        $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getStyle($cells)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                    'rgb' => $color
            )
        ));
    }
    cellColorLocalePermissions('A1', '1F4E79');
    $j=1;
    foreach(range('B','E') as $columnID){
        cellColorLocalePermissions($columnID.$j, 'DEEBF7');
    }

    //setfontsize
    $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getStyle("A1:M3000")->applyFromArray($styleArray3);
    //setcfontcolors
    $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getStyle('A1')->applyFromArray($styleArray2);

    //Sets current sheets dimensions to auto size of column width
    $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getColumnDimension('A')
                ->setWidth('10');
    foreach(range('B','E') as $columnID){
                $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getColumnDimension($columnID)
                ->setAutoSize(true);
    }
    $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getColumnDimension('B')
                ->setAutoSize(false);
    $objPHPExcel->getSheetByName('LOCALE PERMISSIONS')->getColumnDimension('B')
                ->setWidth('35');

    $objPHPExcel->removeSheetByIndex(
        $objPHPExcel->getIndex(
            $objPHPExcel->getSheetByName('Worksheet')
        )
    );


    $objPHPExcel->setActiveSheetIndexByName('METADATA');

    $authrolesUsers = $_POST['inviRoles'];
    $authrolesUsersDecoded = json_decode($authrolesUsers, true);
    $varRole = 2;
    $varRoleUser = 2;

    if(!empty($authrolesUsers)){
        for($roleIndex=0;$roleIndex<sizeof($authrolesUsersDecoded);$roleIndex++){
            $objPHPExcel->getSheetByName('ROLES')->setCellValue('B'.$varRole, $authrolesUsersDecoded[$roleIndex]["role"]); 
            $varRole++;
        }

        for($roleUserIndex=0;$roleUserIndex<sizeof($authrolesUsersDecoded);$roleUserIndex++){
            $authUsers_arr = preg_split ("/\n/", $authrolesUsersDecoded[$roleUserIndex]["user"]);
            for($userIndex=0;$userIndex<sizeof($authUsers_arr);$userIndex++){
                $varLtrim = ltrim($authUsers_arr[$userIndex]," ");
                $varRtrim = rtrim($varLtrim," ");
                if($varRtrim!=""){
                $objPHPExcel->getSheetByName('USERS')->setCellValue('B'.$varRoleUser, $varRtrim);
                $objPHPExcel->getSheetByName('USERS')->setCellValue('F'.$varRoleUser, $varRtrim);
                $objPHPExcel->getSheetByName('USERS')->setCellValue('C'.$varRoleUser, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                $objPHPExcel->getSheetByName('USERS')->setCellValue('D'.$varRoleUser, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                $objPHPExcel->getSheetByName('USERS')->setCellValue('G'.$varRoleUser, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                $varRoleUser++;
                }
            }    
        }

        $authThingDetails = $_POST['inviThing'];
        $authThingDetailsDecoded = json_decode($authThingDetails, true);
        $domains = "generic,baseModel,digitalAsset,thing,taxonomyModel,referenceData";
        $domains_arr = preg_split ("/\,/", $domains);
        $authContextTypeNames = $_POST['inviContextDetails'];
        $authContextTypeNamesDecoded = json_decode($authContextTypeNames, true);
        $authContextAttrs = $_POST['inviContext'];
        $authContextAttrsDecoded = json_decode($authContextAttrs, true);
        $varBaseRowIndex = 2;

            
            for($roleUserIndex=0;$roleUserIndex<sizeof($authrolesUsersDecoded);$roleUserIndex++){
                for($domainIndex=0;$domainIndex<sizeof($domains_arr);$domainIndex++){
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('B'.$varBaseRowIndex, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('C'.$varBaseRowIndex, $domains_arr[$domainIndex]);
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('G'.$varBaseRowIndex, 'RW');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('H'.$varBaseRowIndex, 'R');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('I'.$varBaseRowIndex, 'R');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('J'.$varBaseRowIndex, 'RW');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('K'.$varBaseRowIndex, 'R');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('L'.$varBaseRowIndex, 'R');            
                    $varBaseRowIndex++;
                }
            }
            
            if(!empty($authThingDetails)){ 
            for($roleUserIndex=0;$roleUserIndex<sizeof($authrolesUsersDecoded);$roleUserIndex++){
                for($authEntityTypeIndex=0;$authEntityTypeIndex<sizeof($authThingDetailsDecoded);$authEntityTypeIndex++){
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('B'.$varBaseRowIndex, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('D'.$varBaseRowIndex, $authThingDetailsDecoded[$authEntityTypeIndex]["entitytype"]);
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('G'.$varBaseRowIndex, 'RW');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('H'.$varBaseRowIndex, 'R');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('I'.$varBaseRowIndex, 'R');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('J'.$varBaseRowIndex, 'R');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('K'.$varBaseRowIndex, 'R');
                    $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('L'.$varBaseRowIndex, 'R');            
                    $varBaseRowIndex++;
                }
            }
        }
        if(!empty($authContextTypeNames) && !empty($authContextAttrs)){
            for($roleUserIndex=0;$roleUserIndex<sizeof($authrolesUsersDecoded);$roleUserIndex++){
                for($authContextEntityTypeIndex=0;$authContextEntityTypeIndex<sizeof($authContextAttrsDecoded);$authContextEntityTypeIndex++){
                    for($authContextTypeIndex=0;$authContextTypeIndex<sizeof($authContextTypeNamesDecoded);$authContextTypeIndex++){
                        $authContextNames_arr = preg_split ("/\n/", $authContextTypeNamesDecoded[$authContextTypeIndex]["contextnames"]);
                        for($contextNameIndex=0;$contextNameIndex<sizeof($authContextNames_arr);$contextNameIndex++){
                            $varLtrim = ltrim($authContextNames_arr[$contextNameIndex]," ");
                            $varRtrim = rtrim($varLtrim," ");
                            if($varRtrim!=""){
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('B'.$varBaseRowIndex, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('D'.$varBaseRowIndex, $authContextAttrsDecoded[$authContextEntityTypeIndex]["contextentitytype"]);
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('E'.$varBaseRowIndex, $authContextTypeNamesDecoded[$authContextTypeIndex]["contexttype"]);
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('F'.$varBaseRowIndex, $varRtrim);
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('G'.$varBaseRowIndex, 'RW');
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('H'.$varBaseRowIndex, 'R');
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('I'.$varBaseRowIndex, 'R');
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('J'.$varBaseRowIndex, 'R');
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('K'.$varBaseRowIndex, 'R');
                            $objPHPExcel->getSheetByName('BASE PERMISSIONS')->setCellValue('L'.$varBaseRowIndex, 'R');            
                            $varBaseRowIndex++;
                            }
                        }
                    }
                }
            }
        }

        $varEarcRowIndex=2;
        if(!empty($authThingDetails)){
            for($roleUserIndex=0;$roleUserIndex<sizeof($authrolesUsersDecoded);$roleUserIndex++){
                for($authEntityTypeIndex=0;$authEntityTypeIndex<sizeof($authThingDetailsDecoded);$authEntityTypeIndex++){
                    $authThingAttrs_arr = preg_split ("/\n/", $authThingDetailsDecoded[$authEntityTypeIndex]["entityattributes"]);
                    for($thingAttrsIndex=0;$thingAttrsIndex<sizeof($authThingAttrs_arr);$thingAttrsIndex++){
                        $varLtrim = ltrim($authThingAttrs_arr[$thingAttrsIndex]," ");
                        $varRtrim = rtrim($varLtrim," ");
                        if($varRtrim!=""){
                        $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('B'.$varEarcRowIndex, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                        $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('C'.$varEarcRowIndex, $authThingDetailsDecoded[$authEntityTypeIndex]["entitytype"]);
                        $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('G'.$varEarcRowIndex, $varRtrim);
                        $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('H'.$varEarcRowIndex, 'Yes');
                        $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('I'.$varEarcRowIndex, 'Yes');
                        $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('J'.$varEarcRowIndex, 'Yes');
                        $varEarcRowIndex++;
                        }  
                    }
                }
            }
        }

        if(!empty($authContextTypeNames) && !empty($authContextAttrs)){
            for($roleUserIndex=0;$roleUserIndex<sizeof($authrolesUsersDecoded);$roleUserIndex++){
                for($authContextTypeIndex=0;$authContextTypeIndex<sizeof($authContextTypeNamesDecoded);$authContextTypeIndex++){ 
                    $authContextNames_arr = preg_split ("/\n/", $authContextTypeNamesDecoded[$authContextTypeIndex]["contextnames"]);
                        for($contextNameIndex=0;$contextNameIndex<sizeof($authContextNames_arr);$contextNameIndex++){ 
                            $varLtrim1 = ltrim($authContextNames_arr[$contextNameIndex]," ");
                            $varRtrim1 = rtrim($varLtrim1," ");
                            if($varRtrim1!=""){  
                            for($authContextEntityTypeIndex=0;$authContextEntityTypeIndex<sizeof($authContextAttrsDecoded);$authContextEntityTypeIndex++){        
                                $authContextAttrs_arr = preg_split ("/\n/", $authContextAttrsDecoded[$authContextEntityTypeIndex]["contextattributes"]);
                                for($contextAttrsIndex=0;$contextAttrsIndex<sizeof($authContextAttrs_arr);$contextAttrsIndex++){
                                    $varLtrim2 = ltrim($authContextAttrs_arr[$contextAttrsIndex]," ");
                                    $varRtrim2 = rtrim($varLtrim2," ");
                                    if($varRtrim2!=""){
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('B'.$varEarcRowIndex, $authrolesUsersDecoded[$roleUserIndex]["role"]);
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('C'.$varEarcRowIndex, $authContextAttrsDecoded[$authContextEntityTypeIndex]["contextentitytype"]);
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('E'.$varEarcRowIndex, $authContextTypeNamesDecoded[$authContextTypeIndex]["contexttype"]);
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('F'.$varEarcRowIndex, $varRtrim1);
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('G'.$varEarcRowIndex, $varRtrim2);
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('H'.$varEarcRowIndex, 'Yes');
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('I'.$varEarcRowIndex, 'Yes');
                                    $objPHPExcel->getSheetByName('EARC PERMISSIONS')->setCellValue('J'.$varEarcRowIndex, 'Yes');
                                    $varEarcRowIndex++;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}
       

    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Type: application/vnd.ms-excel');
    // header('Content-Disposition: attachment;filename="'.'060-authorization-model.xlsx"');
    // header('Cache-Control: max-age=0');
    // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // ob_end_clean();    
    // $objWriter->save('php://output');
    // exit() ;
    

    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Disposition: attachment;filename="060-authorization-model.xlsx"');
    // header('Cache-Control: max-age=0');
    // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // ob_end_clean();
    // $objWriter->save('php://output');
    // exit;

//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//header('Content-Type: application/vnd.ms-excel; charset=utf-8');
// header("Pragma: no-cache");
// header("Expires: 0");

ob_end_clean();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="060-authorization-model.xls"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_end_clean();
$objWriter->save('php://output');
exit();



