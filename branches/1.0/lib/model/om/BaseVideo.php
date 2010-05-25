<?php


abstract class BaseVideo extends BaseObject  implements Persistent {


	
	const DATABASE_NAME = 'propel';

	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $description;


	
	protected $filename;


	
	protected $preview;


	
	protected $video_type_id;


	
	protected $include_on_sample = true;

	
	protected $aVideoType;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getDescription()
	{

		return $this->description;
	}

	
	public function getFilename()
	{

		return $this->filename;
	}

	
	public function getPreview()
	{

		return $this->preview;
	}

	
	public function getVideoTypeId()
	{

		return $this->video_type_id;
	}

	
	public function getIncludeOnSample()
	{

		return $this->include_on_sample;
	}

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = VideoPeer::ID;
		}

	} 
	
	public function setName($v)
	{

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = VideoPeer::NAME;
		}

	} 
	
	public function setDescription($v)
	{

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = VideoPeer::DESCRIPTION;
		}

	} 
	
	public function setFilename($v)
	{

		if ($this->filename !== $v) {
			$this->filename = $v;
			$this->modifiedColumns[] = VideoPeer::FILENAME;
		}

	} 
	
	public function setPreview($v)
	{

		if ($this->preview !== $v) {
			$this->preview = $v;
			$this->modifiedColumns[] = VideoPeer::PREVIEW;
		}

	} 
	
	public function setVideoTypeId($v)
	{

		if ($this->video_type_id !== $v) {
			$this->video_type_id = $v;
			$this->modifiedColumns[] = VideoPeer::VIDEO_TYPE_ID;
		}

		if ($this->aVideoType !== null && $this->aVideoType->getId() !== $v) {
			$this->aVideoType = null;
		}

	} 
	
	public function setIncludeOnSample($v)
	{

		if ($this->include_on_sample !== $v || $v === true) {
			$this->include_on_sample = $v;
			$this->modifiedColumns[] = VideoPeer::INCLUDE_ON_SAMPLE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->description = $rs->getString($startcol + 2);

			$this->filename = $rs->getString($startcol + 3);

			$this->preview = $rs->getString($startcol + 4);

			$this->video_type_id = $rs->getInt($startcol + 5);

			$this->include_on_sample = $rs->getBoolean($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Video object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VideoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VideoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aVideoType !== null) {
				if ($this->aVideoType->isModified()) {
					$affectedRows += $this->aVideoType->save($con);
				}
				$this->setVideoType($this->aVideoType);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = VideoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += VideoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aVideoType !== null) {
				if (!$this->aVideoType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aVideoType->getValidationFailures());
				}
			}


			if (($retval = VideoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VideoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getDescription();
				break;
			case 3:
				return $this->getFilename();
				break;
			case 4:
				return $this->getPreview();
				break;
			case 5:
				return $this->getVideoTypeId();
				break;
			case 6:
				return $this->getIncludeOnSample();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VideoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDescription(),
			$keys[3] => $this->getFilename(),
			$keys[4] => $this->getPreview(),
			$keys[5] => $this->getVideoTypeId(),
			$keys[6] => $this->getIncludeOnSample(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VideoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setDescription($value);
				break;
			case 3:
				$this->setFilename($value);
				break;
			case 4:
				$this->setPreview($value);
				break;
			case 5:
				$this->setVideoTypeId($value);
				break;
			case 6:
				$this->setIncludeOnSample($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VideoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescription($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFilename($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPreview($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setVideoTypeId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIncludeOnSample($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(VideoPeer::DATABASE_NAME);

		if ($this->isColumnModified(VideoPeer::ID)) $criteria->add(VideoPeer::ID, $this->id);
		if ($this->isColumnModified(VideoPeer::NAME)) $criteria->add(VideoPeer::NAME, $this->name);
		if ($this->isColumnModified(VideoPeer::DESCRIPTION)) $criteria->add(VideoPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(VideoPeer::FILENAME)) $criteria->add(VideoPeer::FILENAME, $this->filename);
		if ($this->isColumnModified(VideoPeer::PREVIEW)) $criteria->add(VideoPeer::PREVIEW, $this->preview);
		if ($this->isColumnModified(VideoPeer::VIDEO_TYPE_ID)) $criteria->add(VideoPeer::VIDEO_TYPE_ID, $this->video_type_id);
		if ($this->isColumnModified(VideoPeer::INCLUDE_ON_SAMPLE)) $criteria->add(VideoPeer::INCLUDE_ON_SAMPLE, $this->include_on_sample);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(VideoPeer::DATABASE_NAME);

		$criteria->add(VideoPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setFilename($this->filename);

		$copyObj->setPreview($this->preview);

		$copyObj->setVideoTypeId($this->video_type_id);

		$copyObj->setIncludeOnSample($this->include_on_sample);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new VideoPeer();
		}
		return self::$peer;
	}

	
	public function setVideoType($v)
	{


		if ($v === null) {
			$this->setVideoTypeId(NULL);
		} else {
			$this->setVideoTypeId($v->getId());
		}


		$this->aVideoType = $v;
	}


	
	public function getVideoType($con = null)
	{
				include_once 'lib/model/om/BaseVideoTypePeer.php';

		if ($this->aVideoType === null && ($this->video_type_id !== null)) {

			$this->aVideoType = VideoTypePeer::retrieveByPK($this->video_type_id, $con);

			
		}
		return $this->aVideoType;
	}

} 