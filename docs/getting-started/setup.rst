Configuración
=============

Para utilizar el cliente de API de BHExpress, se debe tener un token de usuario, generado y obtenido desde la cuenta de BHExpress.

.. important::
    El archivo test.env sólo sirve para usar con los test. Por lo que se deberán definir las variables de entorno por los siguientes dos métodos: Directo por consola (temporal), o definirlas en tu entorno directamente (persistente). La segunda opción varía según el Sistema Operativo.

En Linux o MacOS:
-----------------

El token se almacena en una variable de entorno. Para almacenar en una variable de entorno, se debe escribir lo siguiente en consola:

.. code-block:: shell
    export BHEXPRESS_API_URL="https://bhexpress.cl"
    export BHEXPRESS_API_TOKEN="token-bhexpress"
    export BHEXPRESS_EMISOR_RUT="66666666-6"

- ``BHEXPRESS_API_TOKEN`` es una cadena de caracteres de un largo fijo. Almacena ese token en un lugar seguro y no lo compartas con nadie.
- ``BHEXPRESS_EMISOR_RUT`` es requerido para que ciertos servicios a consumir funcionen.

Introducir en consola las variables de entorno almacena temporalmente las variables, y alternativamente, se puede modificar el archivo de configuración de shell en Linux (que se explicará a continuación), y añadir al final del archivo los comandos previamente introducidos. Añadir variables de entorno de esta forma es más persistente y no se repite su definición.

- Si se usa Linux, se deben añadir al archivo ``~/.bashrc`` los comandos previamente definidos.
- Si se usa MacOS, se deben añadir al archivo ``~/.zshrc``.

El paso siguiente sólo se hace para usuarios de MacOS. Por último, ejecutar el comando en cuestión para efectuar los cambios.

.. code-block:: shell
    source ~/.zshrc

En Windows:
-----------

Para almacenar en una variable de entorno en Windows, hay varias alternativas. La primera es utilizando cmd, y para almacenarlas utilizando cmd, ejecuta en el buscador de Windows "cmd", y ejecuta los siguientes comandos:

.. code-block:: shell
    setx BHEXPRESS_API_URL "https://bhexpress.cl"
    setx BHEXPRESS_API_TOKEN "token-bhexpress"
    setx BHEXPRESS_EMISOR_RUT "66666666-6"

También se pueden definir utilizando Windows PowerShell, de una manera similar. Ejecuta en el buscador de Windows "PowerShell", y ejecuta los siguientes comandos:

.. code-block:: shell
    $Env:BHEXPRESS_API_URL="https://bhexpress.cl"
    $Env:BHEXPRESS_API_TOKEN="token-bhexpress"
    $Env:BHEXPRESS_EMISOR_RUT="66666666-6"

Como alternativa para almacenar las variables de manera persistente, debes seguir los siguientes pasos:

1.  Abre el Panel de Control > Sistema > Configuración avanzada del sistema.
2.  En la pestaña Opciones avanzadas, selecciona Variables de entorno.
3.  Añade o modifica las variables en la sección de "Variables de usuario" o "Variables del sistema".
