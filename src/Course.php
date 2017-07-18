<?php

    class Course
    {
        private $name;
        private $code;
        private $id;

        function __contsruct($name, $code, $id = null)
        {
            $this->name = $name;
            $this->code = $code;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getCode()
        {
            return $this->code;
        }

        function setCode($new_code)
        {
            $this->code = (string) $new_code;
        }

        function getId()
        {
            return $this->id;
        }


    }
 ?>
