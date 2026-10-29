<?php

return [
    'confirmed' => 'La confirmación del campo :attribute no coincide.',
    'current_password' => 'La contraseña actual no es correcta.',
    'dimensions' => 'Las imágenes deben tener dimensiones superiores a 600x600 px.',
    'email' => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
    'image' => 'El campo :attribute debe ser una imagen.',
    'max' => [
        'array' => 'El campo :attribute no debe contener más de :max elementos.',
        'file' => 'El archivo :attribute no debe superar los :max KB.',
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe tener más de :max caracteres.',
    ],
    'min' => [
        'array' => 'El campo :attribute debe contener al menos :min elementos.',
        'file' => 'El archivo :attribute debe tener al menos :min kilobytes.',
        'numeric' => 'El campo :attribute debe ser como mínimo :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'unique' => 'El valor del campo :attribute ya está en uso.',
    'uploaded' => 'El archivo supera los 4096 KB.',
    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'title' => 'título',
        'description' => 'descripción',
        'price' => 'precio',
        'category' => 'categoría',
        'images' => 'imágenes',
        'images.*' => 'imagen',
        'temporary_images' => 'imágenes temporales',
        'temporary_images.*' => 'imagen temporal',
    ],
];
