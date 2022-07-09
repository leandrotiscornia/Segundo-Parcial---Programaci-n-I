<?php
    require "../utils/autoload.php";

    class BlogModelo extends Modelo{
        public $Id
        public $Nombre
        public $IdDeUsuario;
        public $Posts

        public function __construct($id=""){
            parent::__construct();
            if($id != ""){
                $this -> id = $id;
                $this -> Obtener();
        }
        private function guardar(){
            if($this -> Id == NULL) $this -> insertar();
            else $this -> actualizar();
        }
        private function insertar(){
            $sql = "INSERT INTO Blog (Nombre, Id_Usuario) VALUES (
                '" . $this -> Nombre . "',
                '" . $this -> IdDeUsuario . "')";
    
                $this -> conexionBaseDeDatos -> query($sql);
        }
        public function Actualizar(){
            $sql = "UPDATE usuario SET
            Nombre = '" $this -> Nombre ."'
            WHERE Id = " . $this -> Id;
            $this -> conexionBaseDeDatos -> query($sql);
        }
        public function Obtener(){
            $sql = "SELECT * FROM Blog WHERE id = " . $this -> Id;
            $fila = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> Id = $fila['Id'];
            $this -> Nombre = $fila['Nombre'];
            $this -> IdDeUsuario = $fila['IdUsuario'];
        }
        public function ObtenerTodos(){
            $sql = "SELECT * FROM blog";
            $filas = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC);

            $resultado = array();
            foreach($filas as $fila){
                $blog = new BlogModelo();
                $blog -> Id = $fila['Id'];
                $blog -> Nombre = $fila['Nombre'];
                $blog -> IdDeUsuario = $fila['IdUsuario'];
                array_push($resultado, $blog);
            }
        }
        public function Eliminar(){
            $sql = "DELETE FROM Blog WHERE Id = " . $this -> Id;
            $this -> conexionBaseDeDatos -> query($sql);
         }
    }