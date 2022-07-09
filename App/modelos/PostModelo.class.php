<?php
require "../utils/autoload.php"
    
    class PostModelo extends Modelo{
        public $Id;
        public $Id_Blog;
        public $Titulo;
        public $Fecha;
        public $Contenido
        public $Comentarios;


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
            $sql = "INSERT INTO Post (Titulo, Fecha) VALUES(
            '" . $this -> Titulo . "',
            '" . $this -> Fecha . "')";
            
            $this -> conexionBaseDeDatos -> query($sql);

            $sql = "INSERT INTO Post_De_Blog (Id_Post, Id_Blog) VALUES(
                Last_Insert_ID(),
                '" . $this -> Blog . "')";
            $this -> conexionBaseDeDatos -> query($sql);  
        }
        private function actualizar(){
            $sql = "UPDATE Post SET
            Titulo = '" $this -> Titulo ."',
            Fecha = NOW(),
            Contenido = '" . $this -> Contenido . "'
            WHERE Id = '" . $this -> Id ."'";
            $this -> conexionBaseDeDatos -> query($sql);
        }
        public function Obtener(){
            $sql = "SELECT * FROM Post WHERE id = " . $this -> Id;
            $fila = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC)[0];

            $this -> Id = $fila['Id'];
            $this -> Titulo = $fila['Titulo'];
            $this -> Fecha = $fila['Fecha'];
            $this -> Contenido = $fila['Contenido'];
        }
        public function ObtenerTodos(){
            $sql = "SELECT * FROM Post
            JOIN Post_De_Blog ON Post_De_Blog.Id_Post = Post.Id,
            WHERE Id_Blog = '" . $this -> Id_Blog "'";
            $filas = $this -> conexionBaseDeDatos -> query($sql) -> fetch_all(MYSQLI_ASSOC);

            $resultado = array();
            foreach($filas as $fila){
                $post = new PostModelo();
                $post -> Id = $fila['Id'];
                $post -> Titulo = $fila['Titulo'];
                $post -> Fecha = $fila['Fecha'];
                $post -> Contenido = $fila['Contenido'];
                array_push($resultado, $blog);
            }
            return $resultado;
        }
        public function Eliminar(){
            $sql = "UPDATE Post SET
            Eliminado = True
            WHERE id = '" . $this -> id . "'";
            $this -> conexionBaseDeDatos -> query($sql);
        }
    }