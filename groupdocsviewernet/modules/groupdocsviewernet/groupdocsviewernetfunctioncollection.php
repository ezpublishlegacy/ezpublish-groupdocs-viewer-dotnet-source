<?php
 include_once( 'extension/groupdocsviewernet/classes/groupdocsviewernet.php' );
/*
class GroupdocsViewerNetFunctionCollection
{

function GroupdocsViewerNetFunctionCollection()
{
}

function &fetchList( $offset, $limit )
{
$parameters = array( 'offset' => $offset,
'limit' => $limit );
$lista =& Groupdocsviewernet( $parameters );

return array( 'result' => &$lista );
}

}
*/
class eZModul1FunctionCollection
{ 
    public function __construct() 
    {
        // ...
    }
 
    /*
     * Is opened by('modul1', 'list', hash('as_object', $bool ) ) fetch
     * @param bool $asObject
     */ 
    public static function fetchList( $asObject ) 
    { 
        return array( 'result' => GroupDocsViewerNet::fetchList( $asObject ) ); 
    }
 
    /*
     * Is opened by('modul1', 'count', hash() ) fetch
     */
    public static function fetchJacExtensionDataListCount()
    { 
        return array( 'result' => GroupDocsViewerNet::getListCount() ); 
    } 
} 
?>