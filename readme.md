# PostalCodeMex Client

[![Latest Stable Version](https://poser.pugx.org/systemEDOM/postalcodemex-client/v/stable)](https://packagist.org/packages/systemEDOM/postalcodemex-client)
[![License](https://poser.pugx.org/systemEDOM/postalcodemex-client/license)](https://packagist.org/packages/systemEDOM/postalcodemex-client)

**PostalCodeMex Client** es una librería para Laravel que permite consumir la API de [PostalCodeMex](http://postalcodemex.omsoft.com.mx). Esta API proporciona información detallada sobre códigos postales, colonias, estados y más.

## Instalación

### Requisitos

- Laravel 9.x, 10.x o superior
- PHP 8.1 o superior

### 1. Instalar el paquete

Puedes instalar el paquete a través de Composer. Ejecuta el siguiente comando en tu proyecto Laravel:

```bash
composer require systemedom/postalcodemex-client
```

### 2. Configuración

Una vez instalado, el paquete se registrará automáticamente en Laravel (gracias al soporte de Laravel 11+ para el descubrimiento automático de paquetes). No necesitas añadir manualmente el ServiceProvider.

Publicar configuración (opcional)
Si deseas personalizar los valores predeterminados, puedes publicar el archivo de configuración:

```bash
php artisan vendor:publish --tag=postalcodemex-config
```
Esto creará el archivo config/postalcodemex.php, donde podrás definir la URL base de la API y tu token de acceso.

### 3. Configurar las variables de entorno

Agrega las siguientes variables a tu archivo .env con la URL y el token de la API de PostalCodeMex: 

```bash
POSTALCODEMEX_API_URL=https://postalcodemex.omsoft.com.mx #Opcional
POSTALCODEMEX_API_TOKEN=tu-token-aqui
```

### 4. Uso

Una vez configurado, puedes usar el cliente para consultar información relacionada con códigos postales, colonias, estados, etc.

Ejemplo: Obtener colonias por código postal
En cualquier controlador, servicio o componente de tu aplicación, puedes hacer lo siguiente:

```php
use PostalCodeMexClient;

$colonias = PostalCodeMexClient::getNeighborhoods('12345');

if ($colonias->successful()) {
    $data = $colonias->json();
    // Maneja los datos de las colonias
} else {
    // Manejar error
}
```

Método disponibles

```php
getNeighborhoods(string $cp): PromiseInterface|Response
getStates(): PromiseInterface|Response
getTownByState(string $state): PromiseInterface|Response
getPostalCodesByTown(string $town): PromiseInterface|Response
getSettlements(): PromiseInterface|Response
getZones(): PromiseInterface|Response
```

### 5. Testing

Si deseas ejecutar las pruebas incluidas en la librería, usa el siguiente comando:


```bash
composer test
```
