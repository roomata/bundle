<?php
/**
 * Created by PhpStorm.
 * User: roomata
 * Date: 27.06.18
 * Time: 21:08
 */

namespace Roomata\CropBundle\Service;


use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Imagick;

class CropImage implements CropImageInterface
{
    /**
     * @var Imagick
     */
    private $file = null;
    private $x;
    private $y;
    private $x1;
    private $y1;
    private $config;
    private $tumbSize;

    public function __construct(array $config)
    {
        $this->config = $config;
    }


    public function setFile(File $file)
    {
        $this->file = NEW Imagick($file->getFilename());
        return $this;
    }

    public function setCoordinates(int $x, int $y, int $x1, int $y1)
    {
        $this->x = $x;
        $this->y = $y;
        $this->x1 = $x1;
        $this->y1 = $y1;
        return $this;
    }

    public function setThumbnail(string $thumbnail)
    {
        if (isset($this->config[$thumbnail])) {
            $this->tumbSize = $this->config[$thumbnail];
        } else {
            throw new HttpException();
        }
        return $this;
    }

    public function crop()
    {
        $this->file->cropImage($this->x, $this->y, $this->x1, $this->y1);
        $this->file->thumbnailImage($this->tumbSize['width'], $this->tumbSize['height']);
        return $this;
    }

    public function getFileString(): string
    {
        $this->file->setImageFormat('jpg');
        return $this->file->getImageBlob();
    }
}