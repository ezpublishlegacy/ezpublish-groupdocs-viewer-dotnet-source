include_once( 'kernel/classes/ezpersistentobject.php' );

class Groupdocsviewernet extends eZPersistentObject
{

function Groupdocsviewernet( $row )
{
$this->eZPersistentObject( $row );
}

function &definition()
{
return array( 'fields' => array(
'id' => array(
'name' => 'id',
'datatype' => 'integer',
'default' => 0,
'required' => true ),
'name' => array(
'name' => 'name',
'datatype' => 'string',
'default' => '',
'required' => true ) ),
'keys' => array( 'id' ),
'increment_key' => 'id',
'class_name' => 'groupdocsviewernet',
'name' => 'gdvn' );
}

function &fetchListFromDB( $parameters = array() )
{
return Groupdocsviewernet::handleList( $parameters, false );
}

function &handleList( $parameters = array(), $asCount = false )
{
$parameters = array_merge( array( 'as_object' => true,
'offset' => false,
'limit' => false ),
$parameters );
$asObject = $parameters['as_object'];
$offset = $parameters['offset'];
$limit = $parameters['limit'];
$limitArray = null;
if ( !$asCount and $offset !== false and $limit !== false )
$limitArray = array( 'offset' => $offset,
'length' => $limit );

return eZPersistentObject::fetchObjectList( Groupdocsviewernet::definition(),
null, null, null, $limitArray,
$asObject );
}

}