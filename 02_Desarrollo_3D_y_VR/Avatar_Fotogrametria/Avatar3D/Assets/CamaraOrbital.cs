using UnityEngine;

public class CamaraOrbital : MonoBehaviour
{
    [Header("Configuración del Visor")]
    public Transform objetivo; // El modelo que vamos a mirar
    public float velocidadRotacion = 5f;
    public float velocidadZoom = 2f;
    public float distanciaMinima = 0.5f;
    public float distanciaMaxima = 3f;

    private float distanciaActual = 1.5f;

    void Start()
    {
        // Calcula la distancia inicial entre la cámara y el modelo
        if (objetivo != null)
        {
            distanciaActual = Vector3.Distance(transform.position, objetivo.position);
        }
    }

    void Update()
    {
        if (objetivo == null) return;

        // --- 1. ROTACIÓN (PC: Clic Izquierdo | Móvil: 1 Dedo) ---
        if (Input.GetMouseButton(0) && Input.touchCount <= 1)
        {
            float mouseX = Input.GetAxis("Mouse X") * velocidadRotacion;
            float mouseY = Input.GetAxis("Mouse Y") * velocidadRotacion;

            // Orbita la cámara alrededor del objetivo
            transform.RotateAround(objetivo.position, Vector3.up, mouseX);
            transform.RotateAround(objetivo.position, transform.right, -mouseY);
        }

        // --- 2. ZOOM (PC: Rueda del Ratón) ---
        float scroll = Input.GetAxis("Mouse ScrollWheel");
        if (Mathf.Abs(scroll) > 0f)
        {
            distanciaActual -= scroll * velocidadZoom;
        }

        // --- 3. ZOOM (Móvil: Pellizco con 2 Dedos) ---
        if (Input.touchCount == 2)
        {
            Touch toqueCero = Input.GetTouch(0);
            Touch toqueUno = Input.GetTouch(1);

            // Posiciones en el fotograma anterior
            Vector2 posicionAnteriorCero = toqueCero.position - toqueCero.deltaPosition;
            Vector2 posicionAnteriorUno = toqueUno.position - toqueUno.deltaPosition;

            // Magnitudes (distancia entre los dedos)
            float magnitudAnterior = (posicionAnteriorCero - posicionAnteriorUno).magnitude;
            float magnitudActual = (toqueCero.position - toqueUno.position).magnitude;

            // Diferencia para saber si acercan o alejan los dedos
            float diferencia = magnitudActual - magnitudAnterior;
            distanciaActual -= diferencia * 0.01f * velocidadZoom;
        }

        // --- APLICAR ZOOM Y MIRAR AL CENTRO ---
        distanciaActual = Mathf.Clamp(distanciaActual, distanciaMinima, distanciaMaxima);
        Vector3 direccion = (transform.position - objetivo.position).normalized;
        transform.position = objetivo.position + direccion * distanciaActual;
        
        // Forzar a la cámara a mirar siempre al modelo (Evita el paneo accidental)
        transform.LookAt(objetivo);
    }
}