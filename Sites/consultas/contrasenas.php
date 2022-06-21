<?php
        // funcion que crea las contraseñas, y luego las escribe en ;
        // La clave va a ser una cantidad aleatoria de letras del nombre de usuario
        //seguido de 

        function crear_contrasena_usuario($nombre_usuario, $numero_pasaporte){
           
                    $largo_usuario = strlen($nombre_usuario) - 1;
                    $largo_pasaporte = strlen($numero_pasaporte) - 1;
                    $largo_random_usuario = rand(1,$largo_usuario);
                    $largo_random_pasaporte = rand(1,$largo_pasaporte);
                    $clave_usuario = substr($nombre_usuario, 0, $largo_random_usuario);
                    $clave_pasaporte = substr($numero_pasaporte, 0, $largo_random_pasaporte);
                    $contrasena = $clave_usuario . '' . $clave_pasaporte;
                    return strtolower($contrasena);
        }
            
        function crear_contrasena_aerolinea() {
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $contrasena[] = $alphabet[$n];
            }
            return strtolower(implode($contrasena)); //turn the array into a string
        }
        
      ?>