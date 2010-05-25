<?php


abstract class BaseVideoType extends BaseObject  implements Persistent {


	
	const DATABASE_NAME = 'propel';

	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $external_link;


	
	protected $external_link_name;

	
	protected $collVideos;

	
	protected $lastVideoCriteria = null;

	
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

	
	public function getExternalLink()
	{

		return $this->external_link;
	}

	
	public function getExternalLinkName()
	{

		return $this->external_link_name;
	}

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = VideoTypePeer::ID;
		}

	} 
	
	public function setName($v)
	{

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = VideoTypePeer::NAME;
		}

	} 
	
	public function setExternalLink($v)
	{

		if ($this->external_link !== $v) {
			$this->external_link = $v;
			$this->modifiedColumns[] = VideoTypePeer::EXTERNAL_LINK;
		}

	} 
	
	public function setExternalLinkName($v)
	{

		if ($this->external_link_name !== $v) {
			$this->external_link_name = $v;
			$this->modifiedColumns[] = VideoTypePeer::EXTERNAL_LINK_NAME;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->external_link = $rs->getString($startcol + 2);

			$this->external_link_name = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating VideoType object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(VideoTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VideoTypePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(VideoTypePeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = VideoTypePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += VideoTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collVideos !== null) {
				foreach($this->collVideos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = VideoTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collVideos !== null) {
					foreach($this->collVideos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VideoTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getExternalLink();
				break;
			case 3:
				return $this->getExternalLinkName();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VideoTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getExternalLink(),
			$keys[3] => $this->getExternalLinkName(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = VideoTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setExternalLink($value);
				break;
			case 3:
				$this->setExternalLinkName($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = VideoTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setExternalLink($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setExternalLinkName($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(VideoTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(VideoTypePeer::ID)) $criteria->add(VideoTypePeer::ID, $this->id);
		if ($this->isColumnModified(VideoTypePeer::NAME)) $criteria->add(VideoTypePeer::NAME, $this->name);
		if ($this->isColumnModified(VideoTypePeer::EXTERNAL_LINK)) $criteria->add(VideoTypePeer::EXTERNAL_LINK, $this->external_link);
		if ($this->isColumnModified(VideoTypePeer::EXTERNAL_LINK_NAME)) $criteria->add(VideoTypePeer::EXTERNAL_LINK_NAME, $this->external_link_name);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(VideoTypePeer::DATABASE_NAME);

		$criteria->add(VideoTypePeer::ID, $this->id);

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

		$copyObj->setExternalLink($this->external_link);

		$copyObj->setExternalLinkName($this->external_link_name);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getVideos() as $relObj) {
				$copyObj->addVideo($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new VideoTypePeer();
		}
		return self::$peer;
	}

	
	public function initVideos()
	{
		if ($this->collVideos === null) {
			$this->collVideos = array();
		}
	}

	
	public function getVideos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseVideoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVideos === null) {
			if ($this->isNew()) {
			   $this->collVideos = array();
			} else {

				$criteria->add(VideoPeer::VIDEO_TYPE_ID, $this->getId());

				VideoPeer::addSelectColumns($criteria);
				$this->collVideos = VideoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(VideoPeer::VIDEO_TYPE_ID, $this->getId());

				VideoPeer::addSelectColumns($criteria);
				if (!isset($this->lastVideoCriteria) || !$this->lastVideoCriteria->equals($criteria)) {
					$this->collVideos = VideoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVideoCriteria = $criteria;
		return $this->collVideos;
	}

	
	public function countVideos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseVideoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VideoPeer::VIDEO_TYPE_ID, $this->getId());

		return VideoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addVideo(Video $l)
	{
		$this->collVideos[] = $l;
		$l->setVideoType($this);
	}

} 