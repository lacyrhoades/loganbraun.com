<?php


	
class PageMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PageMapBuilder';	

    
    private $dbMap;

	
    public function isBuilt()
    {
        return ($this->dbMap !== null);
    }

	
    public function getDatabaseMap()
    {
        return $this->dbMap;
    }

    
    public function doBuild()
    {
		$this->dbMap = Propel::getDatabaseMap('propel');
		
		$tMap = $this->dbMap->addTable('page');
		$tMap->setPhpName('Page');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('TITLE', 'Title', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('NAV_TITLE', 'NavTitle', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BODY', 'Body', 'string', CreoleTypes::LONGVARCHAR, false);

		$tMap->addColumn('SORT_ORDER', 'SortOrder', 'int', CreoleTypes::INTEGER, false);

		$tMap->addColumn('SPECIAL_HANDLING', 'SpecialHandling', 'string', CreoleTypes::VARCHAR, false, 255);
				
    } 
} 