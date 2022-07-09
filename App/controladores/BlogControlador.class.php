<?php 
    require "../utils/autoload.php";

    class BlogControlador{
        public static function Alta($context){
            $Blog = new BlogModelo();
            $Blog -> Id_Usuario = $context['post']['id_usuario'];
            $Blog -> Nombre = $context['post']['nombre'];
            $Blog -> Guardar();
        }
        public static function Modificar($context){
            $Blog = new BlogModelo();
            $Blog -> Id = $context['post']['id'];
            $Blog -> Id_Usuario = $context['post']['id_usuario'];
            $Blog -> Nombre = $context['post']['nombre'];
            $Blog -> Guardar();
        }
        public static function Obtener($context){
            $Blog = new BlogModelo();
            return $Blog -> Obtener();
        }
        public static function Eliminar($context){
            $Blog = new BlogModelo();
            $Blog -> Id = $context['post']['id'];
            $Blog -> Eliminar();
        }
    }