<?php

require "../utils/autoload.php"

    class ComentarioModelo extends Modelo{
        public $Id;
        public $Id_Usuario;
        public $Id_Post
        public $Fecha;
        public $Contenido;

        public function __construct($id =""){
            parent::__construct();
            if($id !=""){
                $this -> Id = $id;
                $this -> Obtener();
            }
        }
        public function Guardar(){
            if($this -> Id ==NULL) $this -> insertar();
            else $this -> actualizar();
        }
        private function insertar(){
            $this -> Fecha = "NOW()";
            $sql = "INSERT INTO Comentario (Id_Usuario, Fecha, Contenido) VALUES (
                '" . $this -> Id_Usuario . "',
                NOW(),
                '" . $this -> this -> Contenido . "')";
    
            $this -> conexionBaseDeDatos -> query($sql);
            
            $sql = "INSERT INTO Comentario_De_Post(Id_Comentario, Id_Post) VALUES(
                 Last_Insert_ID(),
                 '" -> $this -> Id_Post . "')";

            $this -> conexionBaseDeDatos -> query($sql);

        }
        private function actualizar(){
            $sql = "UPDATE Comentario SET
            Id_Usuario = '" . $this -> Id_Usuario . "',
            Fecha = NOW(),
            Contenido = '" .$this -> Contenido . "'
            WHERE id = '" . $this -> id . "'";
            $this -> conexionBaseDeDatos -> query($sql);
        }
        public function Obtener(){
            $sql = "SELECT * FROM Comentario WHERE id = " . $this -> id;
            $fila = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> Id = $fila['Id'];
            $this -> Id_Usuario = $fila['Id_Usuario'];
            $this -> Fecha = $fila['Fecha'];
            $this -> Contenido = $fila['Contenido'];
        }
        public function ObtenerTodos(){
            $sql = "SELECT * FROM Comentario
                JOIN Comentario_De_Post ON Comentario_De_Post.Id_Comentario = Comentario.Id 
                WHERE Id_Post = '" . $this -> Id_Post . "'";
            $filas = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC);

            $resultado = array();
            foreach($filas as $fila){
                $comentario = new ComentarioModelo();
                $comentario -> Id = $fila['Id'];
                $comentario -> Id_Usuario = $fila['Id_Usuario'];
                $comentario -> Fecha = $fila['Fecha'];
                $comentario -> Contenido = $fila['Contenido'];
                array_push($resultado, $comentario);
            }
            return $resultado
        }
        public function Eliminar(){
            $sql = "UPDATE Comentario SET
            Contenido = 'Comentario eliminado'
            WHERE id = '" . $this -> id . "'";
            $this -> conexionBaseDeDatos -> query($sql);
        }
    }