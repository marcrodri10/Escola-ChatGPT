<?php

    //create translations for the different languages

    //welcom translations
    $welcomTranslation = [
        'es' => 'Bienvenido',
        'ca' => 'Benvingut',
        'en' => 'Welcome',
        'de' => 'Herzlich willkommen',
        'it' => 'Benvenuto',
        'fr' => 'Bienvenue',
    ];

    //user data translations
    $dataTranslations = [
        'es' => ['nombre','apellidos','email', 'rol'],
        'ca' => ['nom','cognoms','email', 'rol'],
        'en' => ['name','lastname','email', 'role'],
        'de' => ['name','nachnamen','email', 'rolle'],
        'it' => ['nome','cognomes','email', 'ruolo'],
        'fr' => ['prenom','nom','email', 'role'],
    ];

    //roles translations
    $userRoleTranslations = [
        'es' => ['alumno', 'profesor'],
        'ca' => ['alumne', 'professor'],
        'en' => ['student', 'teacher'],
        'de' => ['schüler', 'professor'],
        'it' => ['studente', 'professore'],
        'fr' => ['etudiant', 'professeur'],
    ];
    
    $navbarTranslations = [
        'es' => [
            'left'=> ['Home', 'Dashboard', 'Matricularse', 'Notas'],
            'right' => ['Perfil', 'Cerrar Sesion', 'Ajustes', 'Inicio Sesion', 'Registrarse'],
        ], 
        'ca' => [
            'left'=> ['Home', 'Dashboard', "Matricula't", 'Notes'],
            'right' => ['Perfil', 'Tancar sessio', 'Configuracio', 'Inici Sessio', 'Registrar-se'],
        ], 
        'en' => [
            'left'=> ['Home', 'Dashboard', 'Enrollment', 'Marks'],
            'right' => ['Profile', 'Logout', 'Settings', 'Login', 'Register'],
        ], 
        'de' => [
            'left'=> ['Home', 'Dashboard', 'Schicken', 'Noten'],
            'right' => ['Profil', 'Zumachen session', 'Einstellungen', 'Anmeldung', 'Registrieren'],
        ], 
        'it' => [
            'left'=> ['Home', 'Dashboard', 'Iscrivere', 'Votos'],
            'right' => ['Profilo', 'Chiudere sessione', 'Configurazione', 'Accedi', 'Registrati'],
        ], 
        'fr' => [
            'left'=> ['Home', 'Dashboard', 'Immatriculer', 'Notes'],
            'right' => ['Profil', 'Fermer session', 'Configuration', "S'identifier", "S'enregistrer"],
        ], 
    ];

    $teacherTranslations = [
        'es' => 'Asignaturas',
        'ca' => 'Asignatures',
        'en' => 'Subjects',
        'de' => 'Facher',
        'it' => 'Materias',
        'fr' => 'Matieres',
    ];

    $footerTranslations = [
        'es' => ['Politica de cookies', 'Aceptar la politica de cookies'],
        'ca' => ['Politica de cookies', 'Acceptar la politica de cookies'],
        'en' => ['Cookies policy', 'Accept cookies policy'],
        'de' => ['Cookie-Richtlinie', 'Akzeptieren Sie die Cookie-Richtlinie'],
        'it' => ['Politica sui cookie', 'Accettare la Politica sui cookie'],
        'fr' => ['Politique de cookies', 'Accepter la politique de cookies'],
    ];

    $buttonsTranslations = [
        'es' => ['Aceptar', 'Eliminar'],
        'ca' => ['Acceptar', 'Eliminar'],
        'en' => ['Accept', 'Delete'],
        'de' => ['Akzeptieren', 'Beseitigen'],
        'it' => ['Accettare', 'Eliminare'],
        'fr' => ['Accepter', 'Eliminer'],
    ];


?>