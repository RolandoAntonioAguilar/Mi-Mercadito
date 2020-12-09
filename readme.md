# Requisitos
    Tener MySql version 8.0 o mayor
    Tener MySql Workbench instalado para ejecutar los scripts
# Paso para Ejecutar el proyecto
    1. Ejecutar los scripts de BD en la carpeta Scripts en el orden listado
    2. En la carpeta de libs buscar el archivo parameters y cambiar el host_server por la URL de localhost que ejecuta el proyecto.
    3. Ejecutar el setup.php para crear el usuario administrator ejemplo "localhost/e-commerce/setup.php" las credenciales se verán en la misma pantalla
    4. Ingresar con las credenciales proveidas y buscar en el menu "Control de horarios" crear un horario con las parametros deseados, una vez creado activarlo regresar a la tabla general y dar al icono con la flecha para activarlo (de otra manera fallará a la hora de hacer la compra)
    5. Irse a Control de Lugares de Entrega y crear un lugar con los parametros deseados
    6. Añadir un producto en control de inventario.
    7. Crear una cuenta en paypal SandBox (para ambientes de prueba) y crear un ClientID y token para luego introducirlos en el archivo paypal.php en la carpeta libs.
    8. Si desea utilizar el modulo de correos con Gmail, utilizar una cuenta que permita la utilización de aplicaciones menos seguras y crear una contraseña para la aplicación en Gmail NO UTILIZAR LA CONTRASEÑA DEL CORREO.
        Link para habilitar aplicaciones menos seguras https://support.google.com/cloudidentity/answer/6260879?hl=es
        Link para crear contraseñas para aplicaciones https://support.google.com/mail/answer/185833?hl=es
# Generalidadeds del Proyecto
    Estilo de proyecto hecho con SASS, este fue uno de los primeros que realice asi que esperen muchas malas prácticas
    La carreta es manejada mediante sessión el archivo encargado de eso lo pueden encontrar en models ->  support -> cart.model.php
    Para la parte de mantenimiento utilice plural para en listar y singular para modificar o crear, es decir categorias.php enlista las categorias existentes y categoria.php es el encargado de modifcar o crear categorias.
# Información General de los módulos
## Configuración de Usuario
    Cambios de información básica y contraseña
## Control de Accesos (Seguridad)
    Maneja los accesos de los roles existentes, cada página se encuentra listada ahí. Las que tengan siglas PGE no se muestran en el menu pero las que terminan en MNU si y deberán de llevar un texto que es el cuál se mostrará en el menu. Cada vez que se quiera aîadir una nueva página se deberá añadir en este módulo.
## Control de Horarios
    Maneja el horario por el cual el negocio funcionará y limites de ordenes a recibir por hora
## Control de Inventario
    Maneja el inventario a ofrecer en la página web, pueden tener "variaciones" las cuales son el mismo producto en diferentes opciones o combos
## Control de Lugar de entrega
    Maneja donde el negocio realiza las entregas
## Control de Usuarios
    Maneja los usuarios registrado en la página web y lugar donde se les puede añadir nuevos roles al modificarlos
## Manejo de Ordenes
    Maneja las ordenes hechas al negocio y al modificarlas puede cambiar el estado en la cúal se encuentran
## Mis direcciones
    Maneja las direcciones ingresadas por el usuario actual (No es global)
## Tipo de Usuarios
    Maneja los roles del sistemas
## Tipos de Categorias
    Manejan las categorias de los productos
## Tipo de Estado de ordenes 
    Maneja los estados de las ordenes