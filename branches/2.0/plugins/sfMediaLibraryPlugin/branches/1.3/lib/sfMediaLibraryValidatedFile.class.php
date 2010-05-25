<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class sfMediaLibraryValidatedFile extends sfValidatedFile
{
  protected $library;

  public function setLibrary($library)
  {
    $this->library = $library;
  }

  public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777)
  {
    $file = parent::save($file, $fileMode, $create, $dirMode);

    $this->library->createThumbnail($this, $file);

    return $file;
  }

  public function generateFilename()
  {
    return sfMediaLibrary::sanitizeFile($this->getOriginalName());
  }
}
