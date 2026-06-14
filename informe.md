# Informe Técnico Breve - Proyecto Multimedia (Parte Grupal)

**Materia:** Multimedia  
**Institución:** Universidad Mayor de San Andrés (UMSA)  
**Integrantes:** [Escribe los nombres aquí]  

---

## 1. Metodología Utilizada

La metodología se centró exclusivamente en el desarrollo de los dos ejes grupales solicitados:

**A. Digitalización de Trámites Universitarios**
*   **Modelado del Proceso:** Se trazaron los diagramas de flujo completos en Draw.io para dos trámites ("Retiro y Adición de Materias" y "Postulación a Ayudantía"), identificando actores, validaciones y estados lógicos.
*   **BPM (Backend y Almacenamiento):** Se programó el motor de estados usando PHP. Para evitar bases de datos tradicionales, la concurrencia y actualización dinámica de los formularios se manejó íntegramente estructurando y manipulando archivos `.json`.

**B. Desarrollo 3D y Realidad Virtual**
*   **Animación Sincronizada en Unity:** Se importó un entorno y múltiples avatares en Unity 3D, configurando un *Animator* para crear una coreografía que reacciona de manera sincronizada a una pista musical, exportando el resultado a WebGL.
*   **Avatar Digital mediante Fotogrametría:** Se procesaron múltiples fotografías de un integrante usando fotogrametría en la nube. El modelo tridimensional resultante se optimizó en Blender (limpieza de malla) y se integró en Unity para su exportación interactiva a web.

---

## 2. Herramientas y Tecnologías Empleadas

### Digitalización de Trámites y Flujo de Trabajo
*   **Draw.io:** Utilizado para la creación del diagrama de flujo y modelado de los procesos de los trámites.
*   **Visual Studio Code (VSCode):** Entorno de Desarrollo Integrado principal.
*   **PHP:** Lenguaje de programación del lado del servidor empleado para la lógica de los trámites.
*   **JSON:** Formato de almacenamiento ligero utilizado como base de datos dinámica para registrar y consultar los datos.

### Desarrollo 3D, Realidad Virtual y Fotogrametría
*   **Google Colab / Software de Fotogrametría:** Entorno empleado para procesar los algoritmos a partir del set de fotografías y generar el modelo 3D base.
*   **Blender:** Software de diseño 3D utilizado para la limpieza de la topología del avatar generado.
*   **Unity 3D:** Motor gráfico utilizado para ensamblar las escenas, integrar el avatar fotogramétrico y configurar la animación de la coreografía sincronizada con audio.
*   **WebGL (HTML5, JS, WASM):** Estándar de renderizado web elegido como formato de exportación desde Unity.
*   **Git, GitHub Pages y Netlify:** Herramientas de control de versiones y hosting empleadas para el despliegue del repositorio y de los motores 3D optimizados.

---

## 3. Capturas de Pantalla y Resultados Obtenidos

*Nota: A continuación se presentan las evidencias del funcionamiento de la parte grupal del sistema web y los entornos tridimensionales.*

### A. Modelado de Procesos (Diagramas de Flujo)
El proyecto cuenta con el modelado lógico de dos trámites independientes:
1. **Retiro y Adición de Materias:** Contempla reglas de negocio como bloqueos por deudas, validación de fechas de cronograma, validación de prerrequisitos, concurrencia en la toma de cupos y resolución por Director de Carrera.
2. **Postulación a Ayudantía de Docencia:** Contempla el ciclo completo desde la postulación, revisión de documentos (Kárdex), examen, cálculo ponderado de notas y la asignación final de plazas titular/invitado.

`[ INSTRUCCIÓN: Inserta aquí las imágenes de tus diagramas de flujo de Draw.io ]`
**Figuras 1 y 2:** Diagramas de flujo detallando entradas, procesos, validaciones y resultados de ambos trámites.

### B. Sistema BPM y Formularios Dinámicos (JSON)
Se implementó un motor de flujo de trabajo propio en PHP que procesa ambos trámites universitarios sin requerir MySQL. La información de los usuarios (estudiantes, kárdex, director) se registra, consulta y actualiza de manera concurrente en archivos estructurados `.json`, validando estados dinámicamente según las reglas del diagrama de flujo.

`[ INSTRUCCIÓN: Inserta aquí 1 o 2 capturas de la interfaz web de tus formularios y una pequeña porción del código JSON guardando los datos ]`
**Figura 3:** Interfaz web del BPM y almacenamiento en formato JSON.

### C. Animación Sincronizada en Unity
Se construyó una escena tridimensional donde múltiples avatares reaccionan mediante *Animation Controllers* en Unity, ejecutando una coreografía que se encuentra sincronizada con una pista musical específica ("La Vaca Lola").

`[ INSTRUCCIÓN: Inserta aquí una captura de Unity mostrando a los personajes en la escena ]`
**Figura 4:** Escena de coreografía en Unity sincronizada con la pista de audio.

### D. Construcción de Avatar (Fotogrametría 3D)
Mediante captura fotográfica, se escaneó a un integrante del grupo. Se generó un modelo 3D denso (nube de puntos y malla) que posteriormente fue sometido a un proceso de limpieza topológica en Blender. El avatar texturizado final fue importado a Unity 3D con un script de cámara orbital para su inspección.

`[ INSTRUCCIÓN: Inserta aquí una captura del modelo 3D dentro de Blender o el software de fotogrametría ]`
**Figura 5:** Proceso de digitalización y limpieza del avatar fotogramétrico.

### E. Portal Web Integrador y Despliegue WebGL
Cumpliendo con los productos esperados, se desarrolló una **Plataforma Web Funcional** (Portal) alojada en GitHub Pages que unifica y enlaza a todos los proyectos de manera responsiva:
* Los sistemas de formularios dinámicos (BPM PHP/JSON) alojados en un servidor remoto.
* La animación 3D de Unity exportada como aplicación WebGL interactiva.
* El modelo fotogramétrico 3D exportado en WebGL y alojado en Netlify para manejar la compresión GZIP nativamente.

`[ INSTRUCCIÓN: Inserta aquí una captura de pantalla del menú principal de tu proyecto (index.html) y de las aplicaciones de Unity corriendo en el navegador ]`
**Figura 6:** Ejecución final del portal integrador y las escenas 3D WebGL.

---

**Enlaces Oficiales del Grupo:**
*   **Repositorio GitHub:** `https://github.com/as7haro7/multimedia_grupal`
*   **Plataforma Web Funcional (Live):** `https://as7haro7.github.io/multimedia_grupal/`