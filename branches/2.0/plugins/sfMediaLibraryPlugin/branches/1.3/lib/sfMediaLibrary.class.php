<?php

class sfMediaLibrary
{
  protected $currentDir, $thumbnailsDir, $uploadDirName, $uploadDir, $relativeWebRoot;

  public function __construct($currentDir, $relativeWebRoot = '')
  {
    $this->currentDir      = $currentDir;
    $this->relativeWebRoot = $relativeWebRoot;
    $this->uploadDirName   = sfConfig::get('app_sfMediaLibrary_upload_dir', str_replace(sfConfig::get('sf_web_dir'), '', sfConfig::get('sf_upload_dir')).'/assets');
    $this->uploadDir       = sfConfig::get('sf_web_dir').'/'.$this->uploadDirName;

    $this->thumbnailsDir = false;
    if (sfConfig::get('app_sfMediaLibrary_use_thumbnails', true) && class_exists('sfThumbnail'))
    {
      $this->thumbnailsDir = sfConfig::get('app_sfMediaLibrary_thumbnails_dir', 'thumbnail');
    }
  }

  public function getCurrentDir()
  {
    return $this->currentDir;
  }

  public function exists()
  {
    return is_dir($this->uploadDir.'/'.$this->currentDir);
  }

  public function getUploadForm()
  {
    return new UploadForm($this);
  }

  public function getRenameForm($current)
  {
    return new RenameForm($this, $current);
  }

  public function getCreateDirectoryForm()
  {
    return new CreateDirectoryForm($this);
  }

  public function getParentDir()
  {
    $tmp = explode('/', $this->currentDir);
    array_pop($tmp);

    return implode('/', $tmp);
  }

  public function getAbsCurrentDir()
  {
    return $this->uploadDir.'/'.$this->currentDir;
  }

  public function getWebAbsCurrentDir()
  {
    return $this->relativeWebRoot.'/'.$this->uploadDirName.'/'.$this->currentDir;
  }

  public function createDirectory($dir)
  {
    $dir = $this->uploadDir.'/'.(empty($this->currentDir) ? '' : $this->currentDir.'/').self::sanitizeDir($dir);

    $old = umask(0000);

    if (!is_dir($dir))
    {
      mkdir($dir, 0777);
    }

    if ($this->thumbnailsDir)
    {
      if (!is_dir($dir.'/'.$this->thumbnailsDir))
      {
        mkdir($dir.'/'.$this->thumbnailsDir, 0777);
      }
    }

    umask($old);
  }

  public function rename($current, $new)
  {
    $new = self::sanitizeFile($new);

    if (!is_dir($this->getAbsCurrentDir().'/'.$current) && !is_file($this->getAbsCurrentDir().'/'.$current))
    {
      return false;
    }

    @rename($this->getAbsCurrentDir().'/'.$current, $this->getAbsCurrentDir().'/'.$new);

    if ($this->thumbnailsDir && file_exists($this->getAbsCurrentDir().'/'.$this->thumbnailsDir.'/'.$current))
    {
      @rename($this->getAbsCurrentDir().'/'.$this->thumbnailsDir.'/'.$current, $this->getAbsCurrentDir().'/'.$this->thumbnailsDir.'/'.$new);
    }
  }

  public function delete($name)
  {
    $path = $this->getAbsCurrentDir().'/'.$name;

    if (is_file($path))
    {
      unlink($path);

      if ($this->thumbnailsDir && is_readable($path = $this->getAbsCurrentDir().'/'.$this->thumbnailsDir.'/'.$name))
      {
        unlink($path);
      }
    }
    else if (is_dir($path))
    {
      sfToolkit::clearDirectory($path);
      rmdir($path);

      if ($this->thumbnailsDir && is_dir($path = $this->getAbsCurrentDir().'/'.$this->thumbnailsDir.'/'.$name))
      {
        sfToolkit::clearDirectory($path);
        rmdir($path);
      }
    }
  }

  public function createThumbnail($file, $filename)
  {
    $ext = $file->getOriginalExtension();
    if ($this->isImage($ext) && $this->thumbnailsDir)
    {
      if (!is_dir($this->getAbsCurrentDir().'/'.$this->thumbnailsDir))
      {
        // If the thumbnails directory doesn't exist, create it now
        $old = umask(0000);
        mkdir($this->getAbsCurrentDir().'/'.$this->thumbnailsDir, 0777, true);
        umask($old);
      }

      $thumbnail = new sfThumbnail(64, 64);
      $thumbnail->loadFile($this->currentDir.'/'.$filename);
      $thumbnail->save($this->getAbsCurrentDir().'/'.$this->thumbnailsDir.'/'.$filename);
    }
  }

  public function getDirectories($dir = null)
  {
    if (null === $dir)
    {
      $dir = $this->currentDir;
    }

    $finder = sfFinder::type('dir')->maxdepth(0)->prune('.*')->discard('.*')->relative();
    if ($this->thumbnailsDir)
    {
      $finder = $finder->discard($this->thumbnailsDir);
    }
    $dirs = $finder->in($this->uploadDir.'/'.$dir);
    sort($dirs);

    return $dirs;
  }

  public function getFiles($imageOnly = false, $dir = null)
  {
    if (null === $dir)
    {
      $dir = $this->currentDir;
    }

    $finder = sfFinder::type('file')->maxdepth(0)->prune('.*')->discard('.*')->relative();
    if ($this->thumbnailsDir)
    {
      $finder = $finder->discard($this->thumbnailsDir);
    }
    $files = $finder->in($this->uploadDir.'/'.$dir);
    sort($files);

    $infos = array();
    foreach ($files as $file)
    {
      $ext = substr($file, strpos($file, '.') - strlen($file) + 1);
      if (!$imageOnly || $this->isImage($ext))
      {
        $infos[$file] = $this->getInfo($dir, $file);
      }
    }

    return $infos;
  }

  protected function getInfo($dir, $filename)
  {
    $webAbsCurrentDir = $this->relativeWebRoot.'/'.$this->uploadDirName.'/'.$dir;
    $absCurrentDir = $this->uploadDir.'/'.$dir;

    $info = array();
    $info['ext']  = substr($filename, strpos($filename, '.') - strlen($filename) + 1);
    $stats = stat($absCurrentDir.'/'.$filename);
    $info['size'] = $stats['size'];
    $info['thumbnail'] = true;
    if ($this->isImage($info['ext']))
    {
      if ($this->thumbnailsDir && is_readable(sfConfig::get('sf_web_dir').$webAbsCurrentDir.'/'.$this->thumbnailsDir.'/'.$filename))
      {
        $info['icon'] = $webAbsCurrentDir.'/'.$this->thumbnailsDir.'/'.$filename;
      }
      else
      {
        $info['icon'] = $webAbsCurrentDir.'/'.$filename;
        $info['thumbnail'] = false;
      }
    }
    else
    {
      if (is_readable(sfConfig::get('sf_web_dir').'/sfMediaLibraryPlugin/images/'.$info['ext'].'.png'))
      {
        $info['icon'] = '/sfMediaLibraryPlugin/images/'.$info['ext'].'.png';
      }
      else
      {
        $info['icon'] = '/sfMediaLibraryPlugin/images/unknown.png';
      }
    }

    return $info;
  }

  protected function isImage($ext)
  {
    return in_array(strtolower($ext), array('png', 'jpg', 'gif'));
  }

  static public function sanitizeDir($dir)
  {
    return preg_replace('/[^a-z0-9_-]/i', '_', $dir);
  }

  static public function sanitizeFile($file)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $file);
  }
}
