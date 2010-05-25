<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 1949 2006-09-05 14:40:20Z fabien $
 */
class BasesfMediaLibraryActions extends sfActions
{
  public function preExecute()
  {
    $this->library = new sfMediaLibrary($this->getRequestParameter('dir'), $this->getRequest()->getRelativeUrlRoot());

    $this->forward404Unless($this->library->exists());
  }

  public function executeIndex()
  {
  }

  public function executeChoice()
  {
    $this->executeIndex();
  }

  public function executeMkdir($request)
  {
    $this->forward404Unless($request->isMethod('POST'));

    $form = $this->library->getCreateDirectoryForm();
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $this->library->createDirectory($form->getValue('name'));
    }

    $this->redirect($this->getController()->genUrl('sfMediaLibrary/index').'?dir='.$request->getParameter('dir'));
  }

  public function executeUpload($request)
  {
    $this->forward404Unless($request->isMethod('POST'));

    $form = $this->library->getUploadForm();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $form->getValue('file')->setLibrary($this->library);
      $form->getValue('file')->save();
    }

    $this->redirect($this->getController()->genUrl('sfMediaLibrary/index').'?dir='.$request->getParameter('dir'));
  }

  public function executeDelete($request)
  {
    $this->library->delete($request->getParameter('name'));

    $this->redirect($this->getController()->genUrl('sfMediaLibrary/index').'?dir='.$request->getParameter('dir'));
  }

  public function executeRename($request)
  {
    $form = $this->library->getRenameForm($request->getParameter('current'));
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $this->library->rename($request->getParameter('current'), $form->getValue('name'));
    }

    $this->redirect($this->getController()->genUrl('sfMediaLibrary/index').'?dir='.$request->getParameter('dir'));
  }
}
