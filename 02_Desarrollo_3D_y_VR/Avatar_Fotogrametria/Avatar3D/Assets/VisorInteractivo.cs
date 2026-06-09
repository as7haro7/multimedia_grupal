using UnityEngine;

public class VisorClasico : MonoBehaviour
{
    public Transform objetivo;
    public float velocidadRotacion = 5f;
    public float sensibilidadZoom = 2f;

    void Update()
    {
        if (objetivo == null) return;

        // ROTACIÓN: Si presionas clic izquierdo, giramos
        if (Input.GetMouseButton(0))
        {
            float mouseX = Input.GetAxis("Mouse X") * velocidadRotacion;
            float mouseY = Input.GetAxis("Mouse Y") * velocidadRotacion;

            transform.RotateAround(objetivo.position, Vector3.up, -mouseX);
            transform.RotateAround(objetivo.position, transform.right, mouseY);
        }

        // ZOOM: Con la rueda del ratón
        float scroll = Input.GetAxis("Mouse ScrollWheel");
        if (scroll != 0)
        {
            transform.position += transform.forward * scroll * sensibilidadZoom;
        }

        // Siempre mirar al objetivo
        transform.LookAt(objetivo);
    }
}