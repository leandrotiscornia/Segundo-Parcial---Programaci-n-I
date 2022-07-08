<?php 

require "../utils/autoload.php";

    class UsuarioModelo extends Modelo{
        public $Id;
        public $Nombre;
        public $Password;
        

        public function __construct($id=""){
            parent::__construct();
            if($id != ""){
                $this -> id = $id;
                $this -> Obtener();
            }
        }

        public function Guardar(){
            if($this -> Id == NULL) $this -> insertar();
            else $this -> actualizar();
        }

        private function insertar(){
            $sql = "INSERT INTO usuario (username,password) VALUES (
            '" . $this -> Nombre . "',
            '" . $this -> hashearPassword($this -> Password) . "')";

            $this -> conexionBaseDeDatos -> query($sql);
        }

        private function hashearPassword($password){
            return password_hash($password,PASSWORD_DEFAULT);
        }

        private function actualizar(){
            $sql = "UPDATE usuario SET
            username = '" . $this -> Nombre . "',
            password = '" . $this -> Password . "'
            WHERE id = " . $this -> id;
            $this -> conexionBaseDeDatos -> query($sql);
        }

        public function Obtener(){
            $sql = "SELECT * FROM usuario WHERE id = " . $this ->id;
            $fila = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> Id = $fila['id'];
            $this -> Nombre = $fila['username'];
        }

        public function Eliminar(){
            $sql = "DELETE FROM usuario WHERE id = " . $this ->Id;
            $this -> conexionBaseDeDatos -> query($sql);
        }

        public function ObtenerTodos(){
            $sql = "SELECT * FROM usuario";
            $filas = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC);

            $resultado = array();
            foreach($filas as $fila){
                $p = new UsuarioModelo();
                $p -> Id = $fila['id'];
                $p -> Nombre = $fila['username'];
                array_push($resultado,$p);
            }
            return $resultado;
        }

        public function Autenticar(){
            $sql = "SELECT * FROM usuario WHERE username = '" . $this -> Nombre . "'";
            $resultado = $this -> conexionBaseDeDatos -> query($sql);
            if($resultado -> num_rows == 0) {
                return false;
            }

            $fila = $resultado -> fetch_all(MYSQLI_ASSOC)[0];
            return $this -> compararPasswords($fila['password']);
        }

        private function compararPasswords($passwordHasheado){
            return password_verify($this -> Password, $passwordHasheado);
        }

    }