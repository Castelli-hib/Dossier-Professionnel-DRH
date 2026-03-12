server {
    listen 80;
    server_name localhost;

    root /var/www/html/public;

    index index.php index.html;

    location / {
        try_files $uri /index.php$is_args$args;
    }

    location ~ \.php$ {
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}


1-server { ... }                      → définit un serveur virtuel (un site) dans Nginx.
2-listen 80;                          → écoute sur le port 80 (HTTP standard).
3-server_name localhost;              → nom du serveur, ici pour développement local.
4-root /var/www/html/public;          → dossier racine du site dans le conteneur.
        . Dans Docker, ./symfony est mappé sur /var/www/html
        . Symfony attend les fichiers publics dans public/

5-index index.php index.html;         → fichiers par défaut si on accède à /.
6- location / { try_files $uri /index.php$is_args$args; }
        . Si la requête correspond à un fichier existant ²          → sert le fichier
        . Sinon                                                     → redirige vers index.php (Symfony gère les routes)

7- location ~ \.php$ { ... }                                        → règles pour traiter les fichiers .php :
        fastcgi_pass php:9000;                                              → envoie les requêtes PHP au conteneur PHP-FPM
        fastcgi_index index.php;                                            → fichier index par défaut
        include fastcgi_params;                                             → inclut les paramètres standards FastCGI
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;   → indique le chemin du fichier PHP à exécuter

Nginx reçoit la requête → si PHP → envoie à PHP-FPM → Symfony répond.