<?php

namespace Setup;

/**
 * Interface for the alway to load object
 * @author Andrea Fiori
 * @since  13 January 2014
 */
interface SetupManagerPreloadInterface
{	
	public function setRecord();
	
	public function getRecord();
}