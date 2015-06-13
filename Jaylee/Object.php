<?php
/**
 * Created by PhpStorm.
 * User: Jaylee
 * Date: 15/6/10
 * Time: 01:06
 */

namespace Jaylee;

class Object {

    public function __get($name){

        $getter =  "get" . $name;
        $setter =  "set" . $name;

        if (method_exists($this, $getter)){

            return $this->$getter();

        }else if (method_exists($this, $setter)){

            throw new \Exception("Getting write-only property: " . get_class($this) . "::" . $name);

        }else {

            throw new \Exception("Getting unknown property: " . get_class($this) . "::" . $name);
        }
    }

    public function __set($name, $value){

        $getter = "get" . $name;
        $setter = "set" . $name;

        if (method_exists($this, $setter)){

            $this->$setter($value);

        }else if (method_exists($this, $getter)){

            throw new \Exception("Setting read-only property: " . get_class($this) . "::" . $name);

        }else {

            throw new \Exception("Setting unknown property: " . get_class($this) . "::" . $name);
        }
    }

    public function __isset($name){

        $getter = "get" . $name;

        if (method_exists($this, $getter)){

            return $this->$getter() !== null;

        }else {

            return false;
        }
    }

    public function __unset($name){

        $setter = "set" . $name;
        $getter = "get" . $name;

        if (method_exists($this, $setter)){

            $this->$setter(null);

        }else if(method_exists($this, $getter)){

            throw new \Exception('Unsetting read-only property: ' . get_class($this) . '::' . $name);
        }
    }
}