<?php


abstract class BasePage extends BaseObject  implements Persistent {


	
	const DATABASE_NAME = 'propel';

	
	protected static $peer;


	
	protected $id;


	
	protected $title;


	
	protected $nav_title;


	
	protected $body;


	
	protected $sort_order;


	
	protected $special_handling;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getTitle()
	{

		return $this->title;
	}

	
	public function getNavTitle()
	{

		return $this->nav_title;
	}

	
	public function getBody()
	{

		return $this->body;
	}

	
	public function getSortOrder()
	{

		return $this->sort_order;
	}

	
	public function getSpecialHandling()
	{

		return $this->special_handling;
	}

	
	public function setId($v)
	{

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PagePeer::ID;
		}

	} 
	
	public function setTitle($v)
	{

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = PagePeer::TITLE;
		}

	} 
	
	public function setNavTitle($v)
	{

		if ($this->nav_title !== $v) {
			$this->nav_title = $v;
			$this->modifiedColumns[] = PagePeer::NAV_TITLE;
		}

	} 
	
	public function setBody($v)
	{

		if ($this->body !== $v) {
			$this->body = $v;
			$this->modifiedColumns[] = PagePeer::BODY;
		}

	} 
	
	public function setSortOrder($v)
	{

		if ($this->sort_order !== $v) {
			$this->sort_order = $v;
			$this->modifiedColumns[] = PagePeer::SORT_ORDER;
		}

	} 
	
	public function setSpecialHandling($v)
	{

		if ($this->special_handling !== $v) {
			$this->special_handling = $v;
			$this->modifiedColumns[] = PagePeer::SPECIAL_HANDLING;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->title = $rs->getString($startcol + 1);

			$this->nav_title = $rs->getString($startcol + 2);

			$this->body = $rs->getString($startcol + 3);

			$this->sort_order = $rs->getInt($startcol + 4);

			$this->special_handling = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Page object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PagePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PagePeer::DATABASE_NAME);
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
					$pk = PagePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PagePeer::doUpdate($this, $con);
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


			if (($retval = PagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getNavTitle();
				break;
			case 3:
				return $this->getBody();
				break;
			case 4:
				return $this->getSortOrder();
				break;
			case 5:
				return $this->getSpecialHandling();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PagePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getNavTitle(),
			$keys[3] => $this->getBody(),
			$keys[4] => $this->getSortOrder(),
			$keys[5] => $this->getSpecialHandling(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setNavTitle($value);
				break;
			case 3:
				$this->setBody($value);
				break;
			case 4:
				$this->setSortOrder($value);
				break;
			case 5:
				$this->setSpecialHandling($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PagePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNavTitle($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBody($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSortOrder($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSpecialHandling($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PagePeer::DATABASE_NAME);

		if ($this->isColumnModified(PagePeer::ID)) $criteria->add(PagePeer::ID, $this->id);
		if ($this->isColumnModified(PagePeer::TITLE)) $criteria->add(PagePeer::TITLE, $this->title);
		if ($this->isColumnModified(PagePeer::NAV_TITLE)) $criteria->add(PagePeer::NAV_TITLE, $this->nav_title);
		if ($this->isColumnModified(PagePeer::BODY)) $criteria->add(PagePeer::BODY, $this->body);
		if ($this->isColumnModified(PagePeer::SORT_ORDER)) $criteria->add(PagePeer::SORT_ORDER, $this->sort_order);
		if ($this->isColumnModified(PagePeer::SPECIAL_HANDLING)) $criteria->add(PagePeer::SPECIAL_HANDLING, $this->special_handling);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PagePeer::DATABASE_NAME);

		$criteria->add(PagePeer::ID, $this->id);

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

		$copyObj->setTitle($this->title);

		$copyObj->setNavTitle($this->nav_title);

		$copyObj->setBody($this->body);

		$copyObj->setSortOrder($this->sort_order);

		$copyObj->setSpecialHandling($this->special_handling);


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
			self::$peer = new PagePeer();
		}
		return self::$peer;
	}

} 