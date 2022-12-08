# Recettes API pour Symfony

## Une API ?

- On parle bien d'**API web** = interface de communication entre et un client et un serveur.
- Objectif : transmettre/échanger/exposer des données **via des URLs**, qu'on appelle des _endpoints_ dans l'univers API.

## Quelle convention pour notre API ?

- L'API REST est LE standard qui défini des règles concernant la structure des requêtes et des réponses échangées.
- [Ce site rappelle les conventions de l'API REST](https://www.restapitutorial.com/lessons/httpmethods.html).

## Et côté Symfony ?

- On crée les routes de l'API (+ le(s) contrôleur(s)).
- On va chercher les données dans le Repository ou on les manipule avec le Manager.
- On va retourner nos données en JSON (encodage).
  - Format d'échange entrée/sortie requête/réponse quand nécessaire = JSON.
  - En cas de création/modification, on va devoir traiter une donnée JSON qui arrive de la requête.
- Dans tous les cas on va renvoyer le bon status code HTTP (200, 201, 404 etc.).

### Nos routes

|Endpoint|Méthode HTTP|Description|Retour|
|-|-|-|-|
|`/api/movies`|`GET`|Récupération de tous les films|200|
|`/api/movies/{id}`|`GET`|Récupération du film dont l'id est fourni|200 ou 404|
|`/api/movies`|`POST`|Ajout d'un film _+ la donnée JSON qui représente le nouveau film_|201 + Location: /movies/{newID}|
|`/api/movies/{id}`|`PUT`|Modification d'un film dont l'id est fourni _+ la donnée JSON qui représente le film modifié_|200, 204 ou 404|
|`/api/movies/{id}`|`DELETE`|Suppression d'un film dont l'id est fourni|200 ou 404|

### Sérialisation des entités

- Après récupération, on veut encoder nos données en JSON, par ex. via `return $this->json($data);` (= on renvoie une réponse JSON).
- Si on tombe sur l'erreur `A circular reference has been detected when serializing the object` c'est à cause des relations et des objets qui bouclent entre eux => :hand: ne pas essayer _tout de suite_ de régler cette configuration comme indiqué sur le net, voir les solutions ci-dessous.

#### Solution 1

Serializer + Groups. Voir exemple sur `api_movies_read`. On utilise le Serializer de Symfony pour convertir les entités Doctrine (objets PHP) en représentation JSON, en appliquant le groupe `movies_read`. Ces groupes sont définis dans les entités que l'on souhaite afficher, ici Movie et Genre. On pourrait ajouter d'autres entités comme Casting et/ou Team sur cet exemple (et dans la réalité, selon les besoins du endpoint de l'API).

#### Autres solutions à tester

- Requêtes custom avec jointures dans le Repository.
- Utiliser la configuration du serializer pour les références circulaires : https://symfony.com/doc/current/components/serializer.html#handling-circular-references

#### Création d'un ressource

> :hand: Attention ici on va devoir recomposer tout le workflow auquel on était habitué avec les automatismes de ParamConverter et des formulaires.

- Request : on récupère le contenu JSON envoyé par le client en tant que _body_ (corps) de la requête. Pour créer la ressource (ici Movie). Le JSON en question doit contenir les propriétés attendues par l'entité concernée, exemple ici :

```json
{
  "title": "",
  "score": 5,
  "summary": "",
  "releaseDate": "1984-10-05T02:00:44+01:00",
  "poster": null
}
```
- ce contenu est récupéré via `$request->getContent();`
- (de)Serializer : on desérialise ce contenu JSON pour le transformer en entité Movie.
- Validator : si l'entité en question contient ses contraintes de validation, on peut valider l'entité directement. Les erreurs rencontrées seront retournées et on pourra les afficher au client avec un status code approprié. Sinon, l'entité est sauvegardée via le Manager de Doctrine. On renvoie une réponse de redirection vers la ressource créée ainsi qu'un status code 201 (Created).

### Sécurité

> Si l'API nous permet de modifier des ressources, alors on souhaitera s'authentifier sur le système et pourvoir suivre le client de requête en requête.

- Se connecter (authentification).
  - Autorisation (les rôles).
- Suivre le client connecté :
  - Session (cookie),
    - Le front et le back doivent être sur le même domaine et le même port.
    - Solution Cookie cross-domain : https://developer.mozilla.org/fr/docs/Web/API/XMLHttpRequest/withCredentials et response.header('Access-Control-Allow-Credentials', true);
  - clé API (token par user, cf https://symfony.com/doc/current/security/guard_authentication.html),
  - JWT, cf jwt.io, cf [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)
  - oAuth

## Utiliser des gestionnaires de requêtes

- [Postman](https://www.getpostman.com/downloads/)
- [Insomnia REST Client](https://insomnia.rest)

## Problèmes connus

### CORS (Cross-Origin Resource Sharing) - Sécurité

#### Avec Apache

Si on utilise Apache, on peut également le configurer de manière plus directe (hors Symfo), avec ce genre de configuration notamment si le front utilise _axios_ (avec _React_) :

```conf
# A ajouter au fichier
# .htaccess du dossier public/

# Always set these headers.
Header always set Access-Control-Allow-Origin "*"
Header always set Access-Control-Allow-Methods "POST, GET, OPTIONS, DELETE, PUT"
Header always set Access-Control-Max-Age "1000"
Header always set Access-Control-Allow-Headers "x-requested-with, Content-Type, origin, authorization, accept, client-security-token"
 
# Added a rewrite to respond with a 200 SUCCESS on every OPTIONS request.
RewriteEngine On
RewriteCond %{REQUEST_METHOD} OPTIONS
RewriteRule ^(.*)$ $1 [R=200,L]
```

Le module `mod_headers` doit être activé (si pas déjà le cas) via cette commande.
```
sudo a2enmod headers
```
Puis redémarrer Apache
```
sudo service apache restart
```

Explications ici : [benjaminhorn.io](https://benjaminhorn.io/code/setting-cors-cross-origin-resource-sharing-on-apache-with-correct-response-headers-allowing-everything-through/)

#### Avec un bundle

Les soucis de CORS peuvent être réglés **plus finement et au sein de Symfony** via [NelmioCorsBundle](https://github.com/nelmio/NelmioCorsBundle). Mais la version Apache plus _brutale_ peut faire l'affaire. Disons que vous n'aurez jamais de soucis de CORS avec la config Apache, alors qu'avec le bundle, si Symfo renvoie une erreur ou que vous avez un bug ou un dump, les en-têtes de CORS peuvent ne pas être émises.

## Bundles pratiques et reconnus pour les API

- [FOSRestBundle](https://symfony.com/doc/current/bundles/FOSRestBundle/index.html) : un bundle pour vous faciliter la création d'API REST.
- [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle) : un bundle qui permet d'authentifier vos utilisateurs si vous avez besoin de sécuriser l'accès à votre API, en utilisant le concept de JWT.