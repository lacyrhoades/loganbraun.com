<?php


	
class VideoTypeMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.VideoTypeMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('video_type');
		$tMap->setPhpName('VideoType');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EXTERNAL_LINK', 'ExternalLink', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('EXTERNAL_LINK_NAME', 'ExternalLinkName', 'string', CreoleTypes::VARCHAR, false, 255);
				
    } 
} 