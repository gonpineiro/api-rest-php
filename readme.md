## Instrucciones

<b>Inicio del servidor REST API:</b>

```console
    php -S localhost:8000 router.php
```
```npm
    npm run serve
```
<hr>

### AUTH

Para utilizar los diferentes métodos de `auth` es necesario descomentar, según sea requerido, las siguientes líneas:

```php
    /*Autenticacion via HTTP */
    include('auth/http.php');

    /* Autenticacion via HMAC */
    include('auth/hmac.php');

    /* Autenticacion via Token */
    include('auth/token.php');
```
<b>Auth HTTP:</b> Para utilizar este método, es necesario tener el módulo `http.php` activado y correr el siguente comando:

```console
    curl "http://<user>:<pwd>@localhost:8000/books"
    
```
```console
    npm run auth:http
```
** Los campos `<user>` y `<pwd>` se configuran dentro del módulo `http.php`.

<b>Auth HMAC:</b> Para utilizar este método, es necesario tener el módulo `hmac.php` y generar un hash con:

```console
    php auth/hmac-hash.php <uid>
```
```console
    npm run auth:hmac:hash
```

Para consultar es necesario correr el siguiente comando CURL, utilizando los datos obtenidos por el `hmac-hash.php`:

```console
    curl http://localhost:8000/books -H 'X-HASH: <hash>' -H 'X-UID: <uid>' -H 'X-TIMESTAMP: <time>'
```

<b>Auth Token:</b> Para utilizar este método, es necesario tener el módulo `token.php`, ademas se debe correr el servidor de `auth` con el siguiente comando:

```console
    php -S localhost:8001 auth/auth-serve.php
```
```npm
    npm run auth:serve:token
```

Para obtener el `Token` del servidor es necesario correr el siguiente comando:

```
    curl http://localhost:8001 -X 'POST' -H 'X-Client-Id: <uid>' -H 'X-Secret:<secret>'
```
** Los campos `<uid>` y `<secret>` se configuran dentro del servidor `auth-serve.php`.

Copiamos el `Token` obtenido por el comando, y para realizar la consultar hay que correr el siguiente comando:

```console
    curl http://localhost:8000/books -H 'X-Token: <token>'
```