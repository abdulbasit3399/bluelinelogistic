<?php

return [

    'blog' =>'Blog',
    'blog_settings' => 'Paramètres du blog',

    'posts' => 'Des postes',
    'categories' => 'Catégories',
    'tags' => 'Mots clés',
    'comments' => 'Commentaires',


    'post_list' => 'Liste des messages',
    'category_list' => 'Liste des catégories',
    'tag_list' => 'Liste de balises',
    'comment_list' => 'Liste de commentaires',

    'create_new_post' => 'Créer un nouveau message',
    'create_new_category' => 'Créer une nouvelle catégorie',
    'create_new_tag' => 'Créer une nouvelle balise',



    'edit_post' => 'Modifier le message',
    'edit_category' => 'Modifier la catégorie',
    'edit_tag' => 'Modifier la balise',
    'edit_comment' => 'Modifier le commentaire',

    'add_post' => 'Ajouter un message',
    'add_category' => 'Ajouter une catégorie',
    'add_new_category' => 'Ajouter une nouvelle catégorie',
    'add_tag' => 'Ajouter une étiquette',


    'selected_posts' => 'messages sélectionnés',
    'selected_categories' => 'catégories sélectionnées',
    'selected_tags' => 'balises sélectionnées',
    'selected_comments' => 'commentaires sélectionnés',

    'select_categories' => 'Sélectionner des catégories',
    'select_posts' => 'Sélectionner les articles',
    'select_tags' => 'Sélectionner les balises',

    'view_post' => "Voir l'article",
    'view_post_page' => 'Afficher la page de message',
    'view_category' => 'Afficher la catégorie',
    'view_category_page' => 'Afficher la page de catégorie',
    'view_tag' => 'Afficher la balise',
    'view_tag_page' => 'Afficher la page des balises',


    'posts_table' => [
        'post' => 'Poste',
        'id' => 'IDENTIFIANT',
        'creator' => 'Créateur par',
        'title' => 'Titre',
        'slug' => 'Limace',
        'content' => 'Contenu',
        'image' => "L'image sélectionnée",
        'post_content' => 'Mettez ici le contenu de votre message',
        'published' => 'publié',
        'active' => 'Actif',
        'visibility' => 'Visibilité',
        'public' => 'Public',
        'auth_user' => 'Utilisateur authentifié',
        'publish_on' =>'Publier sur',
        'seo_title' => 'Titre pour le référencement',
        'seo_description' => 'Description pour le référencement',
        'seo' => 'SEO',
        'post_content_section' => 'Publier un contenu',
        'comments_count' => 'Les commentaires comptent',
        'choose_post' => 'Choisir le poste',
    ],

    'categories_table' => [
        'category' => 'Catégorie',
        'id' => 'IDENTIFIANT',
        'creator' => 'Créateur par',
        'parent_category' => 'Catégorie Parentale',
        'choose_category' => 'Choisir une catégorie',
        'name' => 'Nom',
        'slug' => 'Limace',
        'description' => 'La description',
        'image' => 'Image de catégorie',
        'active' => 'Actif',

        'en_name' => 'nom anglais',
        'ar_name' => 'nom arabe',
        'en_description' => 'description en anglais',
        'ar_description' => 'description arabe',
    ],

    'tags_table' => [
        'tag' => 'Étiquette',
        'id' => 'IDENTIFIANT',
        'creator' => 'Créateur par',
        'name' => 'Nom',
        'slug' => 'Limace',
        'description' => 'La description',
        'choose_tags' => 'Choisir les balises',
        'choose_tags_or_add_new' => 'Choisir des balises ou en ajouter de nouvelles',
    ],


    'comments_table' => [
        'comment' => 'Commentaire',
        'id' => 'IDENTIFIANT',
        'creator' => 'Créateur par',
        'content' => 'Contenu',
        'author_name' => "Nom de l'auteur",
        'author_email' => "Courriel de l'auteur",
        'author_website' => "Site de l'auteur",
    ],



    'widget_post' => [
        'one_block_and_more_side' =>'Un bloc et plus de côté',
        'side_image_blocks' => "Blocs d'images latéraux",
        'timeline_post_list' => 'Liste des messages de la chronologie',
        'full_width_blocks' => 'Blocs pleine largeur',
        'half_width_blocks' => 'Blocs demi-largeur',

        'section_title' => 'Section titre',
        'view_style' => 'Style de vue',
        'posts_order' => 'Ordre des messages',
        'posts_count' => 'Les messages comptent',
        'display_rating' => 'Afficher la note',
        'display_category' => "Catégorie d'affichage",
        'display_load_posts_button' => 'Afficher le bouton de chargement des publications',

        'order_post_types' => [
            'latest' => 'Dernière (date de publication)',
            'most_commented' => 'Le plus commenté',
            'random' => 'Aléatoire'
        ],
    ],

    'widget_newsletter' => [
        'newsletter' => 'Bulletin',
        'get_even_more' => 'Obtenez encore plus',
        'form_description' => 'Abonnez-vous à notre liste de diffusion pour recevoir les nouvelles mises à jour !',
        'your_email_address' => 'Votre adresse e-mail',
        'msg_spam' => 'Ne vous inquiétez pas, nous ne spammons pas.',
        'signup' => "S'inscrire",
    ],


    'widget_recent_comments' => [
        'recent_comments' => 'Commentaires récents',
        'comments_count' => 'Les commentaires comptent',
        'parent_only' => 'Afficher les commentaires de niveau un (uniquement)'
    ],
];