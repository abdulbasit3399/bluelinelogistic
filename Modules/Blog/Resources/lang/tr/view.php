<?php

return [

    'blog' =>'Blog',
    'blog_settings' => 'Blog ayarları',

    'posts' => 'Gönderiler',
    'categories' => 'Kategoriler',
    'tags' => 'Etiketler',
    'comments' => 'Yorumlar',


    'post_list' => 'Posta listesi',
    'category_list' => 'Kategori Listesi',
    'tag_list' => 'Etiket listesi',
    'comment_list' => 'Yorum listesi',

    'create_new_post' => 'Yeni gönderi oluştur',
    'create_new_category' => 'Yeni kategori oluştur',
    'create_new_tag' => 'Yeni etiket oluştur',



    'edit_post' => 'Gönderiyi düzenle',
    'edit_category' => 'Kategoriyi düzenle',
    'edit_tag' => 'Etiketi düzenle',
    'edit_comment' => 'Yorumu düzenle',

    'add_post' => 'Yazı ekle',
    'add_category' => 'Kategori ekle',
    'add_new_category' => 'Yeni Kategori Ekle',
    'add_tag' => 'Etiket ekle',


    'selected_posts' => 'seçilmiş gönderiler',
    'selected_categories' => 'seçilen kategoriler',
    'selected_tags' => 'seçilen etiketler',
    'selected_comments' => 'seçilmiş yorumlar',

    'select_categories' => 'Kategorileri seçin',
    'select_posts' => 'Gönderileri seçin',
    'select_tags' => 'Etiketleri seçin',

    'view_post' => 'Gönderiyi görüntüle',
    'view_post_page' => 'Posta Sayfasını Görüntüle',
    'view_category' => 'Kategoriyi Görüntüle',
    'view_category_page' => 'Kategori Sayfasını Görüntüle',
    'view_tag' => 'Etiketi Görüntüle',
    'view_tag_page' => 'Etiket Sayfasını Görüntüle',


    'posts_table' => [
        'post' =>'Postalamak',
        'id' => 'İD',
        'creator' => 'Yaratıcı tarafından',
        'title' => 'Başlık',
        'slug' => 'Sümüklü böcek',
        'content' => 'İçerik',
        'image' => 'Özellikli resim',
        'post_content' => 'Yazının içeriğini buraya koy',
        'published' => 'Yayınlanan',
        'active' => 'Aktif',
        'visibility' => 'Görünürlük',
        'public' => 'Halk',
        'auth_user' => 'Yetkili kullanıcı',
        'publish_on' => 'Yayınla',
        'seo_title' => 'SEO Başlığı',
        'seo_description' => 'SEO için Açıklama',
        'seo' => 'SEO',
        'post_content_section' => 'Mesaj İçeriği',
        'comments_count' => 'Yorumlar sayılır',
        'choose_post' => 'Gönderi seç',
    ],

    'categories_table' => [
        'category' =>'Kategori',
        'id' => 'İD',
        'creator' => 'Yaratıcı tarafından',
        'parent_category' => 'Aile kategorisi',
        'choose_category' => 'Kategori Seçin',
        'name' => 'İsim',
        'slug' => 'Sümüklü böcek',
        'description' => 'Tanım',
        'image' => 'Kategori resmi',
        'active' => 'Aktif',

        'en_name' => 'ingilizce isim',
        'ar_name' => 'arapça isim',
        'en_description' => 'ingiliz açıklaması',
        'ar_description' => 'arapça açıklama',
    ],

    'tags_table' => [
        'tag' =>'Etiket',
        'id' => 'İD',
        'creator' => 'Yaratıcı tarafından',
        'name' => 'İsim',
        'slug' => 'Sümüklü böcek',
        'description' => 'Tanım',
        'choose_tags' => 'Etiketleri seçin',
        'choose_tags_or_add_new' => 'Etiketler seçin veya yeni ekleyin',
    ],


    'comments_table' => [
        'comment' =>'Yorum',
        'id' => 'İD',
        'creator' => 'Yaratıcı tarafından',
        'content' => 'İçerik',
        'author_name' => 'Yazar adı',
        'author_email' => 'Yazar e-postası',
        'author_website' => 'Yazar web sitesi',
    ],



    'widget_post' => [
        'one_block_and_more_side' =>'Bir blok ve daha fazla taraf',
        'side_image_blocks' => 'Yan görüntü blokları',
        'timeline_post_list' => 'Zaman çizelgesi gönderi listesi',
        'full_width_blocks' => 'Tam genişlik blokları',
        'half_width_blocks' => 'Yarı genişlikli bloklar',

        'section_title' => 'Bölüm başlığı',
        'view_style' => 'Görünüm stili',
        'posts_order' => 'Mesaj sırası',
        'posts_count' => 'Mesajlar sayılır',
        'display_rating' => 'Görüntüleme derecelendirmesi',
        'display_category' => 'Görüntüleme kategorisi',
        'display_load_posts_button' => 'Gönderileri yükle düğmesini görüntüle',

        'order_post_types' => [
            'latest' =>'En son (yayın tarihi)',
            'most_commented' => 'En çok yorum yapılan',
            'random' => 'Rastgele'
        ],
    ],

    'widget_newsletter' => [
        'newsletter' =>'Bülten',
        'get_even_more' => 'Daha Fazlasını Alın',
        'form_description' => 'Yeni güncellemeleri almak için e-posta listemize abone olun!',
        'your_email_address' => 'E-posta adresiniz',
        'msg_spam' => 'Merak etmeyin, spam göndermiyoruz.',
        'signup' => 'Üye olmak',
    ],


    'widget_recent_comments' => [
        'recent_comments' =>'Son Yorumlar',
        'comments_count' => 'Yorumlar sayılır',
        'parent_only' => 'Birinci düzeydeki yorumları görüntüle (yalnızca)'
    ],
];