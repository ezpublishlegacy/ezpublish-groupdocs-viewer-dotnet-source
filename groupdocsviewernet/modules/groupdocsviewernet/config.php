<?php

/**
 * File containing the eZ Publish view implementation.
 *
 * @copyright GroupDocs
 * @version 1.0
 * @extention groupdocsviewernet
 */
/*

 */
///////////////////////////////////////// FORM STARTED /////////////////////////////////////////
// take copy of global object 
$db = eZDB::instance();
$http = eZHTTPTool::instance();

// Create mysql table if not exist
if (!isset($_SESSION['gdvncreatetable']) || !$_SESSION['gdvncreatetable']) {
    $query = 'CREATE TABLE IF NOT EXISTS `gdvn` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `url` varchar(250) NOT NULL,
						  `file_hook` varchar(250) NOT NULL,
						  `width` int(5) NOT NULL,
						  `height` int(5) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM;';
    $db->query($query);
    $_SESSION['gdvcreatetable'] = 1;
}

include_once( 'extension/groupdocsviewernet/classes/groupdocsviewernet.php' );
$module = $Params['Module'];

// If the variable 'name' is sent by GET or POST, show variable 
$value = '';

// DELETE GroupDocs File ID 
if ($http->hasVariable('del_id')) {
    $del_id = $http->variable('del_id');
    $query = 'DELETE FROM gdvn WHERE id=' . (int) $del_id;
    $db->arrayQuery($query);
    return $module->redirectTo('/groupdocsviewernet/config');
}

// SAVE GroupDocs File ID
if ($http->hasVariable('url')) {
    $url = $http->variable('url');
    $width = (int) $http->variable('width');
    $height = (int) $http->variable('height');

    if ($url != '') {

        if (substr($url, -1) != "/") {
            $url = $url . "/";
        }
        // assign hook_id
        $HookId = GroupDocsViewerNet::getMaxId();
        $file_hook = '#gdviewernet' . ($HookId + 1) . '#'; // as no records show zero
        // generate new data object 
        $GDObject = GroupDocsViewerNet::create($url, $file_hook, $width, $height);
        eZDebug::writeDebug('1.' . print_r($GDObject, true), 'GDObject before saving: ID not set');

        // save object in database 
        $GDObject->store();
        eZDebug::writeDebug('2.' . print_r($GDObject, true), 'GDObject after saving: ID set');

        // ask for the ID of the new created object 
        $id = $GDObject->attribute('id');

        // investigate the amount of data existing 
        $count = GroupDocsViewerNet::getListCount();
        $statusMessage = 'URL: >>' . $url .
                '<< Hook:  >>' . $hook .
                '<< In database with ID >>' . $id .
                '<< saved!New ammount = ' . $count;

        return $module->redirectTo('/groupdocsviewernet/config');
    } else
        $statusMessage = 'Please insert data';

    // initialize Templateobject 
    $tpl = eZTemplate::factory();

    $tpl->setVariable('status_message', $statusMessage);
    // Write variable $statusMessage in the file eZ Debug Output / Log 
    // here the 4 different types: Notice, Debug, Warning, Error 
    eZDebug::writeNotice($statusMessage, 'groupdocsviewernet:groupdocsviewernet/config.php');
    eZDebug::writeDebug($statusMessage, 'groupdocsviewernet:groupdocsviewernet/config.php');
    eZDebug::writeWarning($statusMessage, 'groupdocsviewernet:groupdocsviewernet/config.php');
    eZDebug::writeError($statusMessage, 'groupdocsviewernet:groupdocsviewernet/config.php');
}
/////////////////////////////////////////// form ended ////////////////////////////////////////////////
// Get list of file from DB
$dataArray = array();
$query = 'SELECT * FROM gdvn';
$rows = $db->arrayQuery($query);
if ($rows)
    foreach ($rows as $row) {
        if ($row['width'] === '0')
            $row['width'] = '';
        if ($row['height'] === '0')
            $row['height'] = '';
        $dataArray[$row['id']] = array($row['url'], $row['file_hook'], $row['width'], $row['height']);
    }
// initialize Templateobject
$tpl = eZTemplate::factory();

// create example Array in the template => {$data_array}
$tpl->setVariable('data_array', $dataArray);
/////////////////////////////////// inistialization ended ///////////////////////////////////////
//carry out internal processing here, none required in this case.
// setting up what to render to the user:
$Result = array();

//$t = $tpl->compileTemplateFile('design:groupdocsviewer/config.tpl');
$t = $tpl->fetch('design:groupdocsviewernet/config.tpl');

$Result['content'] = $t; //main tpl file to display the output

$Result['left_menu'] = "design:groupdocsviewernet/leftmenu.tpl";

$Result['path'] = array(array(
        'url' => 'groupdocsviewernet/config',
        'text' => 'Groupdocs Viewer for .NET'
    )); //what to show in the Title bar for this URL
// read variable GdvDebug of INI block [GDVExtensionSettings] 
// of INI file jacextension.ini  

$groupdocsviewernetINI = eZINI::instance('groupdocsviewernet.ini');

$gdvnDebug = $groupdocsviewernetINI->variable('GDVNExtensionSetting', 'JacDebug');

// If Debug is activated do something 
if ($gdvnDebug === 'enabled')
    echo 'groupdocsviewernet.ini: [GDVNExtensionSetting] GdvnDebug=enabled';
?>