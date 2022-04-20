<?php
    function generatePassword($length, $specialCharacters, $numbers){
        if($length < $specialCharacters + $numbers){
            return false;
        }
        else{
            $alphabets = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
            $characters = "!@#$%^&*?";
            $nums = "0123456789";
            $passwordGenerated = "";
            
            for($i=0; $i<$specialCharacters; $i++){
                $index = rand(0, strlen($characters) - 1);
                $passwordGenerated .= $characters[$index];
            }

            for($i=0; $i<$numbers; $i++){
                $index = rand(0, strlen($nums) - 1);
                $passwordGenerated .= $nums[$index];
            }

            for($i=0; $i<$length - ($specialCharacters + $numbers); $i++){
                $index = rand(0, strlen($alphabets) - 1);
                $passwordGenerated .= $alphabets[$index];
            }

            return str_shuffle($passwordGenerated);
        }
    }
?>