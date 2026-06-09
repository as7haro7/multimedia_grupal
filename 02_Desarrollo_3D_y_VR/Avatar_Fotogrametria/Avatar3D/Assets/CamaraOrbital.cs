using UnityEngine;

public class CamaraOrbital : MonoBehaviour
{
    [Header("Configuración del Visor")]
    public Transform objetivo; // El modelo que vamos a mirar
    
    // NUEVO: Esto sube el punto de enfoque para que no mire a los pies
    public Vector3 offsetAltura = new Vector3(0, 1.5f, 0); 

    // MEJORA: Valores aumentados para que el movimiento sea rápido y fluido
    public float velocidadRotacion = 45f; 
    public float velocidadZoom = 25f;      
    public float distanciaMinima = 0.5f;
    public float distanciaMaxima = 5f;

    private float distanciaActual = 1.5f;

    void Start()
    {
        // Calcula la distancia inicial apuntando a la nueva altura
        if (objetivo != null)
        {
            Vector3 centroAjustado = objetivo.position + offsetAltura;
            distanciaActual = Vector3.Distance(transform.position, centroAjustado);
        }
    }

    void Update()
    {
        if (objetivo == null) return;

        // Calculamos el nuevo centro (Pecho/Cabeza) en cada frame
        Vector3 centroAjustado = objetivo.position + offsetAltura;

        // --- 1. ROTACIÓN (PC: Clic Izquierdo | Móvil: 1 Dedo) ---
        if (Input.GetMouseButton(0) && Input.touchCount <= 1)
        {
            float mouseX = Input.GetAxis("Mouse X") * velocidadRotacion;
            float mouseY = Input.GetAxis("Mouse Y") * velocidadRotacion;

            // Orbita la cámara alrededor del centro ajustado, no de los pies
            transform.RotateAround(centroAjustado, Vector3.up, mouseX);
            transform.RotateAround(centroAjustado, transform.right, -mouseY);
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

            Vector2 posicionAnteriorCero = toqueCero.position - toqueCero.deltaPosition;
            Vector2 posicionAnteriorUno = toqueUno.position - toqueUno.deltaPosition;

            float magnitudAnterior = (posicionAnteriorCero - posicionAnteriorUno).magnitude;
            float magnitudActual = (toqueCero.position - toqueUno.position).magnitude;

            float diferencia = magnitudActual - magnitudAnterior;
            // MEJORA: Cambié el 0.01f a 0.05f para que el zoom táctil sea más rápido
            distanciaActual -= diferencia * 0.05f * velocidadZoom; 
        }

        // --- APLICAR ZOOM Y MIRAR AL CENTRO ---
        distanciaActual = Mathf.Clamp(distanciaActual, distanciaMinima, distanciaMaxima);
        Vector3 direccion = (transform.position - centroAjustado).normalized;
        transform.position = centroAjustado + direccion * distanciaActual;
        
        // Forzar a la cámara a mirar siempre al pecho/cabeza
        transform.LookAt(centroAjustado);
    }
}