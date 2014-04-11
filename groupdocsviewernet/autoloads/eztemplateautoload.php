<?php
include_once( 'extension/groupdocsviewernet/classes/groupdocsviewernet.php' );

/** 
 * Operator: gvdn('list') and gvdn('count') <br> 
 * Count: {gvdn('count')} <br> 
 * Liste: {gvdn('list')|attribute(show)} 
 */ 
class GVDNOperator
{ 
    public $Operators;
 
    public function __construct( $name = 'gvdn' )
    { 
        $this->Operators = array( $name ); 
    }
 
    /** 
     * Returns the template operators.
     * @return array
     */ 
    function operatorList()
    { 
        return $this->Operators; 
    }
 
    /**
     * Returns true to tell the template engine that the parameter list 
     * exists per operator type. 
     */ 
    public function namedParameterPerOperator() 
    { 
        return true; 
    }
 
    /**
     * @see eZTemplateOperator::namedParameterList 
     **/ 
    public function namedParameterList() 
    { 
        return array( 'gvdn' => array( 'result_type' => array( 'type' => 'string',    
                                                              'required' => true, 
                                                              'default' => 'list' ))
                    ); 
    }
 
    /**
     * Depending of the parameters that have been transmitted, fetch objects JACExtensionData 
     * {gvdn('list)} or count data {gvdn('count')} 
     */ 
    public function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters )
    { 
        $result_type = $namedParameters['result_type']; 
        if( $result_type == 'list') 
            $operatorValue = GroupDocsViewerNet::fetchList(true); 
        else if( $result_type == 'count') 
            $operatorValue = GroupDocsViewerNet::getListCount(); 
    } 
} 
?>