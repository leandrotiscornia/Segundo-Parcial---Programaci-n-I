<?php 
    require "../utils/autoload.php";

    class ComentarioControlador{
        public static function Alta($context){
            $Comentario = new ComentarioModelo();
            $Comentario -> Id_Usuario = $context['post']['id_usuario'];
            $Comentario -> Id_Post = $context['post']['id_post'];
            $Comentario -> Contenido = $context['post']['contenido'];
            $Comentario -> Guardar();
        }
        public static function Modificar($context){
            $Comentario = new ComentarioModelo();
            $Comentario -> Id = $context['post']['id'];
            $Comentario -> Id_Usuario = $context['post']['id_usuario'];
            $Comentario -> Id_Post = $context['post']['id_post'];
            $Comentario -> Contenido = $context['post']['contenido'];
            $Comentario -> Guardar();
            
        }
        public static function Obtener($context){
            $Comentario = new ComentarioModelo();
            $Comentario -> Id_Post = $context['post']['id_post'];
            return $Comentario -> ObtenerTodos();
        }
        public static function Eliminar($context){
            $Comentario = new ComentarioModelo();
            $Comentario -> Id = $context['post']['id'];
            $Comentario -> Eliminar();
        }
    }