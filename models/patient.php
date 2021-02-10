<?php 

    class Patient{
        private $_id;
        private $_lastname;
        private $_firstname;
        private $_birthdate;
        private $_phone;
        private $_mail;
    
        public function __construct($lastname,$firstname,$birthdate,$phone,$mail)
        {
            $this->_lastname = $lastname;
            $this->_firstname = $firstname;
            $this->_birthdate = $birthdate;
            $this->_phone = $phone;
            $this->_mail = $mail;
        }
    }

?>
