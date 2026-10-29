<?php

return [
    'accepted' => 'Il campo :attribute deve essere accettato.',
    'array' => 'Il campo :attribute deve essere un elenco valido.',
    'confirmed' => 'La conferma del campo :attribute non corrisponde.',
    'current_password' => 'La password attuale non è corretta.',
    'email' => 'Il campo :attribute deve essere un indirizzo email valido.',
    'file' => 'Il campo :attribute deve essere un file.',
    'image' => 'Il campo :attribute deve essere un\'immagine.',
    'max' => [
        'array' => "L'anteprima non può contenere più di :max :attribute.",
        'file' => 'Il file :attribute non può superare :max KB.',
        'numeric' => 'Il campo :attribute non può essere maggiore di :max.',
        'string' => 'Il campo :attribute non può contenere più di :max caratteri.',
    ],
    'min' => [
        'array' => 'Il campo :attribute deve contenere almeno :min elementi.',
        'file' => 'Il file :attribute deve avere una dimensione di almeno :min kilobyte.',
        'numeric' => 'Il campo :attribute deve essere almeno :min.',
        'string' => 'Il campo :attribute deve contenere almeno :min caratteri.',
    ],
    'numeric' => 'Il campo :attribute deve essere un numero.',
    'password' => [
        'letters' => 'Il campo :attribute deve contenere almeno una lettera.',
        'mixed' => 'Il campo :attribute deve contenere almeno una lettera maiuscola e una minuscola.',
        'numbers' => 'Il campo :attribute deve contenere almeno un numero.',
        'symbols' => 'Il campo :attribute deve contenere almeno un simbolo.',
        'uncompromised' => 'La password scelta è stata coinvolta in una violazione dei dati. Scegline un\'altra.',
    ],
    'required' => 'Il campo :attribute è obbligatorio.',
    'string' => 'Il campo :attribute deve essere una stringa di testo.',
    'unique' => 'Il valore del campo :attribute è già in uso.',
    'uploaded' => 'Caricamento del file non riuscito. Controlla formato e dimensione.',
    'attributes' => [
        'name' => 'nome',
        'email' => 'email',
        'password' => 'password',
        'password_confirmation' => 'conferma della password',
        'current_password' => 'password attuale',
        'title' => 'titolo',
        'description' => 'descrizione',
        'price' => 'prezzo',
        'category' => 'categoria',
        'images' => 'immagini',
        'images.*' => 'immagine',
        'temporary_images' => 'immagini temporanee',
        'temporary_images.*' => 'immagine',
    ],
    'custom' => [
        'images' => [
            'max' => 'Puoi caricare al massimo :max immagini.',
        ],
        'images.*' => [
            'mimes' => 'Formati ammessi: JPG, PNG, GIF, WEBP, BMP.',
            'file' => 'Il file caricato non è valido.',
        ],
        'temporary_images.*' => [
            'mimes' => 'Formati ammessi: JPG, PNG, GIF, WEBP, BMP.',
            'max' => 'Ogni immagine può pesare al massimo 4 MB.',
        ],
    ],
];
