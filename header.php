<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head()?>
</head>
    <body>
        <header>
            <img src="/pixaweb/wp-content/themes/pixawebtheme/assets/img/logo_pixaweb.svg"/>
            <?php wp_nav_menu(['theme_location' => 'primary',
                                'menu_class' => 'menu-principal',
            ])?>
        </header>