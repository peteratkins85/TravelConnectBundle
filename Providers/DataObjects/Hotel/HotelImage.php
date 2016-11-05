<?php
/**
 * Created by PhpStorm.
 * User: peteratkins
 * Date: 07/06/2016
 * Time: 00:55
 */

namespace Oni\TravelPortBundle\Providers\DataObjects\Hotel;


class HotelImage
{


    protected $thumbImage;

    protected $largeImage;

    /**
     * @param mixed $largeImage
     */
    public function setLargeImage($largeImage)
    {
        $this->largeImage = $largeImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLargeImage()
    {
        return $this->largeImage;
    }

    /**
     * @param mixed $thumbImage
     */
    public function setThumbImage($thumbImage)
    {
        $this->thumbImage = $thumbImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getThumbImage()
    {
        return $this->thumbImage;
    }




}