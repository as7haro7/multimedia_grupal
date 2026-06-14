# Proyecto Final - Multimedia

**Universidad Mayor de San Andrés**  
**Facultad de Ciencias Puras y Naturales**  
**Carrera de Informática**  
**Materia:** MULTIMEDIA

## Integrantes
* Espinoza Ticona Yherco Yhafar
* Mamani Cocasapa Paola Raquel
* Mendoza Mamani Ricardo Einer
* Poma Condori Erick Fernando




## ¿Qué contiene el proyecto?
El sistema está dividido en tres módulos interactivos principales:
1. **Digitalización de Trámites Universitarios (BPM):** Un motor de flujo de trabajo propio construido en PHP que gestiona formularios dinámicos para trámites académicos (como "Retiro y Adición de materias" y "Ayudantía"). Utiliza archivos JSON dinámicos como base de datos concurrente, descartando la necesidad de servidores MySQL tradicionales.
2. **Animación Sincronizada en 3D (Unity):** Una escena tridimensional donde múltiples avatares virtuales realizan una coreografía, respondiendo a *Animation Controllers* sincronizados al ritmo de una pista musical específica ("La Vaca Lola").
3. **Avatar Digital por Fotogrametría:** Un modelo tridimensional generado algorítmicamente a partir de múltiples fotografías reales de un integrante del grupo. El modelo pasó por un proceso de limpieza topológica (Blender) y fue integrado a Unity para su inspección mediante una cámara orbital.

---

## ¿Cómo usar y ejecutar el proyecto en local?

Dado que el proyecto contiene peticiones de red locales (fetch para WebGL) y lógica de servidor (PHP para los formularios y JSON), **no funcionará haciendo doble clic en el archivo `index.html`**. Debe ejecutarse a través de un servidor local.

### 1. Requisitos Previos
* Debes tener instalado un entorno de servidor web local que soporte PHP (por ejemplo, **XAMPP**, **WAMP**, **Laragon** o **MAMP**).
* Un navegador web moderno (Chrome, Firefox, Edge o Brave) para renderizar gráficamente WebGL.

### 2. Instalación y Ejecución
1. **Clonar/Descargar:** Descarga el proyecto en formato `.zip` y descomprímelo, o clona este repositorio.
2. **Mover al Servidor Local:** Copia la carpeta completa del proyecto y pégala en el directorio raíz de tu servidor web:
   * Si usas **XAMPP**: Pégala dentro de `C:/xampp/htdocs/`
   * Si usas **WAMP**: Pégala dentro de `C:/wamp/www/`
3. **Encender el Servidor:** Abre el panel de control de tu servidor (ej. XAMPP Control Panel) y enciende el módulo **Apache**. *(Nota: No es necesario encender el servicio de MySQL, ya que todo el almacenamiento se maneja dinámicamente mediante archivos JSON).*
4. **Abrir la Plataforma:** Abre tu navegador web de preferencia e ingresa la siguiente ruta en la barra de direcciones:
   ```text
   http://localhost/nombre_de_la_carpeta/
   ```
   *(Asegúrate de reemplazar "nombre_de_la_carpeta" por el nombre exacto de la carpeta que pegaste en tu servidor).*

### 3. Navegación
Una vez cargado el portal principal, podrás utilizar el menú interactivo para acceder a los formularios dinámicos (Trámites) y explorar los entornos tridimensionales WebGL renderizados en tiempo real en tu navegador.
