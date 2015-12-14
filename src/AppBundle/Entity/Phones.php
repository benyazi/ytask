<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phones
 *
 * @ORM\Table(name="phones")
 * @ORM\Entity
 */
class Phones
{
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=15, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set phone
     *
     * @param string $phone
     * @return Phones
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Phones
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    public function isSending() {
        $first = mb_substr($this->getPhone(),0,1,"UTF-8");
        if($first=="7") {
            return true;
        }
        return false;
    }
    static function validNumber($number) {
        $phone = trim($number);
        $len = mb_strlen($phone);
        if($len>11) {
            return false;
        }
        elseif($len==11) {
            $first = mb_substr($phone,0,1,"UTF-8");
            if($first=='8' || $first=='7') {
                $second = mb_substr($phone,1,1,"UTF-8");
                if($second == '9') {
                    return '7'.mb_substr($phone,1,10,"UTF-8");
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        elseif($len==10) {
            $first = mb_substr($phone,0,1,"UTF-8");
            if($first == '9') {
                return '7'.$phone;
            }
            else {
                return false;
            }
        }
        elseif($len==6) {
            return '83852'.$phone;
        }
        return false;
    }


    public function __toString() {
        return $this->getPhone();
    }
}
