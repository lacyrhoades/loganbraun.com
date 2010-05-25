<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfRichTextEditorTinyMCE implements the TinyMCE rich text editor.
 *
 * <b>Options:</b>
 *  - css - Path to the TinyMCE editor stylesheet
 *
 *    <b>Css example:</b>
 *    <code>
 *    / * user: foo * / => without spaces. 'foo' is the name in the select box
 *    .foobar
 *    {
 *      color: #f00;
 *    }
 *    </code>
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfRichTextEditorTinyMCE.class.php 3284 2007-01-15 19:05:48Z fabien $
 */
class sfRichTextEditorTinyMCE extends sfRichTextEditor
{
  /**
   * Returns the rich text editor as HTML.
   *
   * @return string Rich text editor HTML representation
   */
  public function toHTML()
  {
    $options = $this->options;

    // we need to know the id for things the rich text editor
    // in advance of building the tag
    $id = _get_option($options, 'id', $this->name);

    // use tinymce's gzipped js?
    $tinymce_file = _get_option($options, 'tinymce_gzip') ? '/tiny_mce_gzip.php' : '/tiny_mce.js';

    // tinymce installed?
    $js_path = sfConfig::get('sf_rich_text_js_dir') ? '/'.sfConfig::get('sf_rich_text_js_dir').$tinymce_file : '/sf/tinymce/js'.$tinymce_file;
    if (!is_readable(sfConfig::get('sf_web_dir').$js_path))
    {
      throw new sfConfigurationException('You must install TinyMCE to use this helper (see rich_text_js_dir settings).');
    }

    sfContext::getInstance()->getResponse()->addJavascript($js_path);

    use_helper('Javascript');

    $tinymce_options = '';
    $style_selector  = '';

    // custom CSS file?
    if ($css_file = _get_option($options, 'css'))
    {
      $css_path = stylesheet_path($css_file);

      sfContext::getInstance()->getResponse()->addStylesheet($css_path);

      $css    = file_get_contents(sfConfig::get('sf_web_dir').DIRECTORY_SEPARATOR.$css_path);
      $styles = array();
      preg_match_all('#^/\*\s*user:\s*(.+?)\s*\*/\s*\015?\012\s*\.([^\s]+)#Smi', $css, $matches, PREG_SET_ORDER);
      foreach ($matches as $match)
      {
        $styles[] = $match[1].'='.$match[2];
      }

      $tinymce_options .= '  content_css: "'.$css_path.'",'."\n";
      $tinymce_options .= '  theme_advanced_styles: "'.implode(';', $styles).'"'."\n";
      $style_selector   = 'styleselect,separator,';
    }
    
    /*
		 * Custom code to always get an ass-kicking Editor (Word style)
		 */
		 $tinymce_options .= ' theme: "advanced", plugins: "table", ';
		 //$tinymce_options .= 'theme_advanced_buttons1_add_before : "save,newdocument,separator", ';
		 $tinymce_options .= 'theme_advanced_buttons1 : "bold, italic, underline, strikethrough, justifyleft, justifycenter, justifyright, justifyfull, fontselect,fontsizeselect", ';
		 $tinymce_options .= 'theme_advanced_buttons2 : "bullist, numlist, outdent, indent, undo, redo, link, unlink, anchor code, hr, forecolor,backcolor, sub, sup, charmap", ';
		 $tinymce_options .= 'theme_advanced_buttons3 : "none", ';
		 //$tinymce_options .= 'theme_advanced_buttons3 : "sub, sup, charmap", ';
		 //$tinymce_options .= 'theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,", ';
		 //$tinymce_options .= 'theme_advanced_buttons3_add_before : "tablecontrols,separator", ';
		 //$tinymce_options .= 'theme_advanced_buttons3_add : "emotions,iespell,media,advhr,separator,print,separator,ltr,rtl,separator,fullscreen", ';
		 //$tinymce_options .= 'theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,spellchecker,cite,abbr,acronym,del,ins,|,visualchars,nonbreaking", ';
		 $tinymce_options .= 'theme_advanced_toolbar_location : "top", ';
		 $tinymce_options .= 'theme_advanced_toolbar_align : "left", ';
		 $tinymce_options .= 'theme_advanced_path_location : "bottom", ';
		 //$tinymce_options .= 'plugin_insertdate_dateFormat : "%Y-%m-%d", ';
		 //$tinymce_options .= 'plugin_insertdate_timeFormat : "%H:%M:%S", ';
		 $tinymce_options .= 'extended_valid_elements : "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]", ';
		 $tinymce_options .= 'paste_auto_cleanup_on_paste : true, ';
		 $tinymce_options .= 'paste_convert_headers_to_strong : true';
		 
		 /*
		  * The following text was taken from between the elements: and relative_urls argument in the tinyMCE.init() call below
  plugins: "table,advimage,advlink,flash",
  theme: "advanced",
  theme_advanced_toolbar_location: "top",
  theme_advanced_toolbar_align: "left",
  theme_advanced_path_location: "bottom",
  theme_advanced_buttons1: "'.$style_selector.'justifyleft,justifycenter,justifyright,justifyfull,separator,bold,italic,strikethrough,separator,sub,sup,separator,charmap",
  theme_advanced_buttons2: "bullist,numlist,separator,outdent,indent,separator,undo,redo,separator,link,unlink,image,flash,separator,cleanup,removeformat,separator,code",
  theme_advanced_buttons3: "tablecontrols",
  extended_valid_elements: "img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]",
			*/

    $culture = sfContext::getInstance()->getUser()->getCulture();

    $tinymce_js = '
tinyMCE.init({
  mode: "exact",
  language: "'.strtolower(substr($culture, 0, 2)).'",
  elements: "'.$id.'",
  relative_urls: false,
  debug: false
  '.($tinymce_options ? ','.$tinymce_options : '').'
  '.(isset($options['tinymce_options']) ? ','.$options['tinymce_options'] : '').'
});';

    if (isset($options['tinymce_options']))
    {
      unset($options['tinymce_options']);
    }

    return
      content_tag('script', javascript_cdata_section($tinymce_js), array('type' => 'text/javascript')).
      content_tag('textarea', $this->content, array_merge(array('name' => $this->name, 'id' => get_id_from_name($id, null)), _convert_options($options)));
  }
}
