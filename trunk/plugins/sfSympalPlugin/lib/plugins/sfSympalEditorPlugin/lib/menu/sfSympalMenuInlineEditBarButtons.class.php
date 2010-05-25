<?php

/**
 * Menu system that represents the inline edit buttons appearing on the frontend
 * 
 * This menu appears in the lower-right corner of the frontend while
 * editing content inline. This holds tools that assist in inline editing
 * 
 * @package     sfSympalEditorPlugin
 * @subpackage  menu
 * @author      Jonathan H. Wage <jonwage@gmail.com>
 * @author      Ryan Weaver <ryan@thatsquality.com>
 * @since       2010-02-27
 * @version     svn:$Id$ $Author$
 */
class sfSympalMenuInlineEditBarButtons extends sfSympalMenu
{
  protected
    $_isEditModeButton = false,
    $_inputClass,
    $_isButton = true,
    $_shortcut;

  public function setShortcut($shortcut)
  {
    $this->_shortcut = $shortcut;
    return $this;
  }

  public function setInputClass($class)
  {
    $this->_inputClass = $class;
    return $this;
  }

  public function isButton($bool = null)
  {
    if ($bool !== null)
    {
      $this->_isButton = $bool;
      return $this;
    }
    return $this->_isButton;
  }

  public function isEditModeButton($bool = null)
  {
    if ($bool !== null)
    {
      $this->_isEditModeButton = $bool;
      return $this;
    }
    return $this->_isEditModeButton;
  }

  public function renderChildBody()
  {
    if ($this->_isButton)
    {
      $class = $this->_isEditModeButton ? $this->_inputClass.' sympal_inline_edit_bar_edit_buttons' : $this->_inputClass;
      if ($this->_route)
      {
        $html = '<a title="'.$this->_shortcut.'" type="button" href="'.url_for($this->_route).'" class="'.$class.'">'.$this->renderLabel().'</a>';
      } else {
        $html = '<a title="'.$this->_shortcut.'" type="button" class="'.$class.'">'.$this->renderLabel().'</a>';
      }
      
      if ($this->_shortcut)
      {
        $html .= '<script type="text/javascript">$(function() { shortcut.add("'.$this->_shortcut.'", function() { $(\'.'.$this->_inputClass.'\').click(); }); });</script>';
      }
    } else {
      $html = parent::renderChildBody();
    }
    return $html;
  }
}