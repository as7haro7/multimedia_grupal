<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trámites Universitarios - BPM</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos del Visor Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(8px);
        }

        .modal-content {
            margin: 2vh auto;
            width: 96vw;
            height: 90vh;
            background: #fff;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: grab;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 30px;
            color: #df0a0a;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            transition: color 0.3s;
        }

        .close-btn:hover {
            color: #794d4d;
        }
    </style>
</head>

<body>
    <div class="bg-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <header>
        <a href="https://as7haro7.xo.je"
            style="color: var(--text-secondary); text-decoration: none; position: absolute; top: 2rem; left: 2rem; font-size: 1.2rem;">
            <i class="fa-solid fa-arrow-left"></i> Volver al Inicio
        </a>
        <h1>Trámites Digitales (BPM)</h1>
        <p>Motor de Workflow basado en archivos JSON y PHP, modelado a partir de diagramas de carriles.</p>
    </header>

    <div class="content-page" style="max-width: 1200px;">
        <!-- Trámite 1 -->
        <div style="margin-bottom: 4rem;">
            <h2 style="font-size: 2rem; color: var(--text-primary); margin-bottom: 1rem;"><i
                    class="fa-solid fa-graduation-cap" style="color: var(--accent);"></i> 1. Retiro y Adición de
                Materias</h2>
            <p style="color: var(--text-secondary); margin-bottom: 1.5rem; line-height: 1.6;">
                Este modelo automatizado contempla bloqueos institucionales (deudas en biblioteca, multas electorales),
                límites académicos y concurrencia de cupos mediante bloqueo de archivos JSON. El estudiante puede
                completar el 90% del trámite de forma automática a menos que requiera intervención del Director de
                Carrera.
            </p>

            <div style="background: #ffffff; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.1); cursor: pointer; transition: transform 0.3s;"
                onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"
                onclick="openModal('retiro_y_adicion_de_materias/retiro_y_adicion_de_materias.png')">
                <img src="retiro_y_adicion_de_materias/retiro_y_adicion_de_materias.png"
                    alt="Diagrama de Retiro y Adición"
                    style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 8px;">
                <p style="font-size: 0.95rem; font-weight: 600; color: var(--accent); margin-top: 0.8rem;"><i
                        class="fa-solid fa-expand"></i> Haz clic para abrir el Visor Interactivo en Pantalla Completa
                </p>
            </div>

            <div style="text-align: center;">
                <a href="retiro_y_adicion_de_materias/iniciologin.php" class="btn">
                    <i class="fa-solid fa-play"></i> Iniciar Workflow
                </a>
            </div>
        </div>

        <hr style="border: 0; border-top: 1px solid var(--card-border); margin: 3rem 0;">

        <!-- Trámite 2 -->
        <div>
            <h2 style="font-size: 2rem; color: var(--text-primary); margin-bottom: 1rem;"><i
                    class="fa-solid fa-chalkboard-user" style="color: var(--accent);"></i> 2. Postulación a Ayudantía de
                Docencia</h2>
            <p style="color: var(--text-secondary); margin-bottom: 1.5rem; line-height: 1.6;">
                Este trámite interdepartamental incluye el manejo de fraudes, tiempos límite, cálculos de notas
                complejas y empates matemáticos. Requiere la intervención de múltiples roles que inician sesión
                secuencialmente: Postulante, Kárdex, Tribunal Evaluador y Consejo de Carrera.
            </p>

            <div style="background: #ffffff; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.1); cursor: pointer; transition: transform 0.3s;"
                onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"
                onclick="openModal('postulacion_a_ayudantia_de_docencia/postulacion_a_ayudantia_de_docencia.png')">
                <img src="postulacion_a_ayudantia_de_docencia/postulacion_a_ayudantia_de_docencia.png"
                    alt="Diagrama de Postulación a Ayudantía"
                    style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 8px;">
                <p style="font-size: 0.95rem; font-weight: 600; color: var(--accent); margin-top: 0.8rem;"><i
                        class="fa-solid fa-expand"></i> Haz clic para abrir el Visor Interactivo en Pantalla Completa
                </p>
            </div>

            <div style="text-align: center;">
                <a href="postulacion_a_ayudantia_de_docencia/iniciologin.php" class="btn">
                    <i class="fa-solid fa-play"></i> Iniciar Workflow
                </a>
            </div>
        </div>
    </div>

    <!-- Visor Modal Oculto -->
    <div id="diagramModal" class="modal">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <div class="modal-content" id="modalContainer" onmousedown="this.style.cursor='grabbing'"
            onmouseup="this.style.cursor='grab'">
            <img id="modalImage" src="" style="max-width: 100%; max-height: 100%;">
        </div>
        <p
            style="position: absolute; bottom: 15px; width: 100%; text-align: center; color: #fff; font-weight: 600; font-size: 1.1rem; pointer-events: none;">
            <i class="fa-solid fa-arrows-up-down-left-right"></i> Usa la rueda del ratón para hacer Zoom y arrastra la
            imagen para Moverla
        </p>
    </div>

    <!-- Panzoom Library -->
    <script src="https://unpkg.com/panzoom@9.4.0/dist/panzoom.min.js"></script>
    <script>
        var pz = null;
        var modal = document.getElementById("diagramModal");
        var modalImg = document.getElementById("modalImage");

        function openModal(imgSrc) {
            modal.style.display = "block";
            modalImg.src = imgSrc;
            document.body.style.overflow = 'hidden'; // Bloquea el scroll de la pagina

            // Inicializa o reinicializa panzoom dentro del modal
            if (pz) { pz.dispose(); }
            pz = panzoom(modalImg, {
                maxZoom: 6,
                minZoom: 0.5,
                bounds: true,
                boundsPadding: 0.1
            });
        }

        function closeModal() {
            modal.style.display = "none";
            document.body.style.overflow = 'auto'; // Restaura el scroll
            if (pz) {
                pz.dispose();
                pz = null;
            }
        }
    </script>
</body>

</html>
