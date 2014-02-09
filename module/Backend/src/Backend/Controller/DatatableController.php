<?php

namespace Backend\Controller;

use Backend\Controller\BackendController;
use Zend\View\Helper\ViewModel;

/**
 * @author Andrea Fiori
 * @since  07 February 2014
 */
class DatatableController extends BackendController
{
	/**
	 * TODO:
	 * 		initialize datatable
	 * @return \Zend\View\Model\ViewModel
	 */
	public function indexAction()
	{
		$setupManager = $this->generateSetupManagerFromInitializerPlugin();
		
		if ( !$this->checkLoginSession($setupManager) ) {
			return $this->renderLoginForm($setupManager);
		}
	
		$setupManager->getTemplateDataSetter()->assignToTemplate('templatePartial', $setupManager->getTemplateDataSetter()->getTemplateData('template_path').'datatable/datatable.phtml');
	
		$this->layout($setupManager->getTemplateDataSetter()->getTemplateData('template_path').'backend.phtml');
		$this->layout()->setVariable("templateData", $setupManager->getTemplateDataSetter()->getTemplateData() );
	
		return new ViewModel();
	}
	
	/**
	 * Get datatable server response
	 * PARAMETERS:
	 * 		columns (array)
	 * 		ID column (string)
	 * 		table name (string)
	 */
	public function datatableJSONResponseAction()
	{
		$aColumns = array('title');
	
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
	
		/* DB table to use */
		$sTable = "posts_options";
	
		/* Database connection information */
		$gaSql['user']       = "root";
		$gaSql['password']   = "";
		$gaSql['db']         = "fossobandito";
		$gaSql['server']     = "localhost";

		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		* no need to edit below this line
		*/

		/*
		 * Local functions
		*/
		function fatal_error( $sErrorMessage = '' )
		{
			header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
			die( $sErrorMessage );
		}
	
		/*
		 * MySQL connection
		*/
		if ( !$gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
		{
			fatal_error( 'Could not open connection to server' );
		}

		if ( ! mysql_select_db( $gaSql['db'], $gaSql['link'] ) )
		{
			fatal_error('Could not select database ');
		}

		/*
		 * Paging
		*/
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
					intval( $_GET['iDisplayLength'] );
		}

		/*
		 * Ordering
		*/
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
							($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
	
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		
		/*
		 * Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
	
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}

		/*
		 * SQL queries
		* Get data to display
		*/
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
			FROM   $sTable
			$sWhere
			$sOrder
			$sLimit
			";
		$rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
	
		/* Data set length after filtering */
		$sQuery = "SELECT FOUND_ROWS() ";
				$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
				$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
				$iFilteredTotal = $aResultFilterTotal[0];
	
				/* Total data set length */
				$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
			FROM   $sTable
			";
			$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
					$aResultTotal = mysql_fetch_array($rResultTotal);
					$iTotal = $aResultTotal[0];
	
					/*
					 * Output
					 */
					$output = array(
				"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
					);
	
					while ( $aRow = mysql_fetch_array( $rResult ) )
					{
						$row = array();
						for ( $i=0 ; $i<count($aColumns) ; $i++ )
							{
							if ( $aColumns[$i] == "version" )
								{
								 /* Special output formatting for 'version' column */
								$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
						}
						else if ( $aColumns[$i] != ' ' )
						{
							/* General output */
							$row[] = $aRow[ $aColumns[$i] ];
						}
				}
				$output['aaData'][] = $row;
		}
		
		//echo json_encode( $output );
			
		$response = $this->getResponse();
		$response->setStatusCode(200);
		$response->setContent(json_encode($output));
		return $response;
	}
}