<?php

namespace Setup;

/**
 * Interface for the alway to load object
 * @author Andrea Fiori
 * @since  13 January 2014
 */
interface SetupManagerAlwaysToLoadInterface
{
	public function setRecord();
	
	public function getRecord();
}