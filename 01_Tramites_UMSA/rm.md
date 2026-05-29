

### 1. Retiro y Adición de Materias

Este modelo contempla los bloqueos institucionales, límites académicos y la concurrencia de datos.

**Actores (Carriles):** Estudiante | Sistema (Motor JSON) | Kárdex | Director de Carrera

* **P1 (Inicio):** El estudiante inicia sesión y accede al módulo.
* **P2 (Validación de Estado Institucional):** El sistema consulta `estudiantes.json` y dependencias.
* *¿Tiene deudas en biblioteca o multas electorales?* $\rightarrow$ **Sí:** Notificación de bloqueo $\rightarrow$ **Fin**.
* *¿Es estudiante regular (matriculado en la gestión actual)?* $\rightarrow$ **No:** Bloqueo $\rightarrow$ **Fin**.
* *Sí a todo:* Avanza.


* **P3 (Validación de Cronograma):** El sistema verifica fechas.
* *¿El sistema está abierto?* $\rightarrow$ **No:** Notificación de fuera de fecha $\rightarrow$ **Fin**.


* **P4 (Interacción):** El sistema carga las materias actuales. El estudiante selecciona qué retirar y qué adicionar (ej. retirar MAT-114, adicionar INF-121).
* **P5 (Validación Límite de Retiros):**
* *¿El retiro lo deja con 0 materias inscritas?* $\rightarrow$ **Sí:** Alerta "Debe hacer trámite de Suspensión Voluntaria, no retiro" $\rightarrow$ **Fin**.


* **P6 (Validación Académica de Adición):** El sistema revisa la malla curricular en el JSON.
* *¿Tiene el prerrequisito aprobado?* $\rightarrow$ **No:**
* *¿Tiene Resolución Facultativa de levantamiento de prerrequisito?* $\rightarrow$ **Sí:** Pasa al carril de **Director de Carrera** para forzar la inscripción manual.
* *No:* Rechazo $\rightarrow$ Retorna a P4.


* *¿Supera el límite de materias/créditos permitidos por semestre (ej. más de 7 materias)?* $\rightarrow$ **Sí:** Rechazo $\rightarrow$ Retorna a P4.
* *¿Existe choque de horarios con sus materias actuales?* $\rightarrow$ **Sí:** Rechazo $\rightarrow$ Retorna a P4.


* **P7 (Validación de Concurrencia y Cupos):** El estudiante presiona "Confirmar". El sistema revisa `materias.json`.
* *¿Quedan cupos en el paralelo?*
* **No:** Alerta "Cupos agotados mientras realizaba el trámite". Sugiere inscribirse en "Lista de Espera" (Guarda estado *"En espera"* en el JSON) $\rightarrow$ Retorna a P4.
* **Sí:** Avanza a P8.




* **P8 (Transacción Segura):** El sistema bloquea el archivo JSON por milisegundos, descuenta el cupo exacto, inscribe al estudiante y libera el archivo.
* **P9 (Resultado):** Generación de boleta actualizada. $\rightarrow$ **Fin**.



### 2. Postulación a Ayudantía de Docencia

Este trámite incluye el manejo de fraudes, tiempos límite, cálculos de notas complejas y empates matemáticos.

**Actores (Carriles):** Postulante | Sistema (Motor JSON) | Kárdex | Tribunal Evaluador | Consejo de Carrera

* **P1 (Inicio):** El postulante accede a la convocatoria.
* **P2 (Filtro Automático de Elegibilidad):** El sistema lee el perfil del estudiante.
* *¿Aprobó la materia a la que postula con nota sobresaliente (ej. $\ge$ 51 o $\ge$ 60 según reglamento)?* $\rightarrow$ **No:** Bloqueo automático.
* *¿Tiene ya 2 ayudantías activas (límite universitario)?* $\rightarrow$ **Sí:** Bloqueo por límite de carga horaria.


* **P3 (Postulación):** Llena el formulario y sube su historial (PDF). Estado JSON: *"Postulado"*.
* **P4 (Revisión de Kárdex):** El administrativo verifica la autenticidad del PDF y los méritos.
* *¿El documento es falso o adulterado?* $\rightarrow$ **Sí:** Estado *"Rechazado"*, se inicia proceso disciplinario $\rightarrow$ **Fin**.
* *¿El documento es ilegible o falta una firma?* $\rightarrow$ **Sí:** Estado *"Observado"*. Notifica al estudiante con un temporizador (ej. 48 horas).
* *¿El estudiante corrige a tiempo?* $\rightarrow$ **Sí:** Vuelve a revisión (P4). **No:** Estado *"Abandono"* $\rightarrow$ **Fin**.


* *Todo correcto:* Estado *"Habilitado para Examen"*.


* **P5 (Examen de Competencia):** Examen físico.
* **P6 (Calificación del Tribunal):** El Tribunal ingresa las notas al sistema.
* *¿El postulante se presentó?* $\rightarrow$ **No:** Estado *"NSP (No se presentó)"* $\rightarrow$ **Fin**.
* *¿La nota del examen es $\ge$ 51?* $\rightarrow$ **No:** Estado *"Reprobado"* $\rightarrow$ **Fin**.


* **P7 (Cálculo Ponderado):** El sistema suma (por ejemplo: 60% examen + 40% méritos de su historial) y genera la Nota Final.
* **P8 (Validación de Plazas y Desempates):** El sistema ordena a los aprobados.
* *¿Alcanza plaza?* $\rightarrow$ **Sí:** Estado *"Titular"*.
* *¿No alcanza plaza?* $\rightarrow$ **Sí:** Estado *"Invitado / Suplente"*.
* *¿Hay un empate exacto (ej. 85.50 pts) en la última plaza disponible?* $\rightarrow$ **Sí:** El flujo cruza a **Tribunal** para aplicar regla de desempate (ej. quién tiene mayor promedio histórico) y decidir al ganador.


* **P9 (Aprobación Final):** El Consejo de Carrera revisa el acta final en el sistema y hace clic en "Homologar Resultados".
* **P10 (Resultado):** El sistema genera la Resolución, actualiza la base de datos JSON de ayudantes activos y notifica por correo a los ganadores. $\rightarrow$ **Fin**.

