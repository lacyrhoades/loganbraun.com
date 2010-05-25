<?php


	
class VideoMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.VideoMapBuilder';	

    
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
		
		$tMap = $this->dbMap->addTable('video');
		$tMap->setPhpName('Video');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false);

		$tMap->addColumn('FILENAME', 'Filename', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('PREVIEW', 'Preview', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addForeignKey('VIDEO_TYPE_ID', 'VideoTypeId', 'int', CreoleTypes::INTEGER, 'video_type', 'ID', false, null);

		$tMap->addColumn('INCLUDE_ON_SAMPLE', 'IncludeOnSample', 'boolean', CreoleTypes::BOOLEAN, false);
				
    } 
} 