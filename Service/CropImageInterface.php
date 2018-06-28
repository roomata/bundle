<?php
/**
 * Created by PhpStorm.
 * User: roomata
 * Date: 28.06.18
 * Time: 0:41
 */

namespace Roomata\CropBundle\Service;


use Symfony\Component\HttpFoundation\File\File;

interface CropImageInterface
{

    public function setFile(File $file);

    public function setCoordinates(int $x, int $y, int $x1, int $x2);

    public function setThumbnail(string $thumbnail);

    public function crop();

    public function getFileString(): string;
}