# Laravel DGII El Salvador 🇸🇻

Laravel DGII es un paquete que te permite generar, firmar y enviar documentos electrónicos (Factura, Guía de remisión, Nota crédito, Nota débito y Comprobante de retención) al DGII (Ecuador).

## Instalar

```bash
composer require dazza-dev/laravel-dgii-sv
```

## Configurar

Publica el archivo de configuración:

```bash
php artisan vendor:publish --tag="laravel-dgii-sv-config"
```

## Migraciones

Publica y ejecuta las migraciones:

```bash
php artisan vendor:publish --tag="laravel-dgii-sv-migrations"
```

```bash
php artisan migrate
```

## Insertar los datos

```bash
php artisan dgii-sv:install
```

## Variables de entorno

```bash
DGII_TEST=true # true o false
DGII_AUTH_NIT=nit_acceso
DGII_AUTH_PASSWORD=clave_acceso
DGII_CERTIFICATE_PATH=ruta_del_certificado
DGII_CERTIFICATE_PASSWORD=clave_del_certificado
DGII_PATH=ruta_donde_se_guardaran_los_archivos
```

## Ejemplos

### Generar un documento electrónico

Para enviar un documento electrónico como Factura, Guía de remisión, Nota crédito, Nota débito o Comprobante de retención. primero debes pasar la estructura de datos que puedes encontrar en: [dazza-dev/dgii-json-generator](https://github.com/dazza-dev/dgii-json-generator).

```php
use DazzaDev\LaravelDgiiSv\Facades\LaravelDgiiSv;

$client = LaravelDgiiSv::getClient();

// Usar el valor en inglés de la tabla
$client->setDocumentType('invoice');

// Datos del documento
$client->setDocumentData($documentData);

// Enviar el documento
$document = $client->sendDocument();
```

### Tipos de documentos disponibles

| Document type             | Nombre en español             |
| ------------------------- | ----------------------------- |
| `invoice`                 | Factura                       |
| `credit-note`             | Nota crédito                  |
| `debit-note`              | Nota débito                   |
| `delivery-note`           | Nota de remisión              |
| `donation-receipt`        | Comprobante de donación       |
| `export-invoice`          | Factura de exportación        |
| `exempt-taxpayer-invoice` | Factura de sujeto excluido    |
| `tax-credit-invoice`      | Comprobante de crédito fiscal |
| `contingency`             | Evento de contingencia        |
| `invalidation`            | Evento de invalidación        |

### Enviar documentos por lotes

Para enviar documentos tributarios electrónicos (DTE) en lotes.

```php
$document = $client->sendBatch(
    documentType: 'invoice',
    documents: $documents
);
```

### Buscar un documento tributario electrónico (DTE)

Para buscar un documento tributario electrónico (DTE) por tipo y código de generación.

```php
$search = $client->search(
    documentType: 'invoice',
    generationCode: '73BF2BF3-6C7B-4530-B1F6-6586906D5604'
);
```

### Buscar por lotes

```php
$search = $client->searchBatch(
    batchCode: 'batch_code'
);
```

### Invalidar un documento tributario electrónico (DTE)

Para invalidar un documento tributario electrónico (DTE) por tipo y código de generación.

```php
$client->setDocumentType('invalidation');
$client->setDocumentData($documentData);

$invalidate = $client->invalidateDocument();
```

### Evento de contingencia

Para enviar un evento de contingencia.

```php
$client->setDocumentType('contingency');
$client->setDocumentData($documentData);

$contingency = $client->contingencyEvent();
```

### Obtener los listados

DGII tiene una lista de códigos que este paquete te pone a disposición para facilitar el trabajo de consultar esto en el anexo técnico:

```php
use DazzaDev\LaravelDgiiSv\Facades\LaravelDgiiSv;

// Obtener los listados disponibles
$listings = LaravelDgiiSv::getListings();

// Consultar los datos de un listado por tipo
$listingByType = LaravelDgiiSv::getListing('tipos-documento');
```

## Contribuciones

Las contribuciones son bienvenidas. Si encuentras algún error o tienes ideas para mejoras, por favor abre un issue o envía un pull request. Asegúrate de seguir las pautas de contribución.

## Autor

Laravel DGII El Salvador fue creado por [DAZZA](https://github.com/dazza-dev).

## Licencia

Este proyecto está licenciado bajo la [MIT License](https://opensource.org/licenses/MIT).
