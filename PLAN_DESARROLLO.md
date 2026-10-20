# Plan de desarrollo de DigiGrow

## Objetivo

Publicar una Fase 1 funcional y lanzar DigiGrow el martes 27 de octubre de 2026.

## Orden obligatorio

**Entorno → Laravel → Filament → Base de datos → Catálogo → Web → WhatsApp → Diseño → Seguridad → VPS → Lanzamiento**

## Cronograma aprobado

| Día | Fecha | Entregables |
|---|---|---|
| Día 1 | Viernes 9 de octubre | Preparar entorno: WSL2, Docker, PHP, Composer, Node/NPM, Git y MySQL. Verificar compatibilidad con Laravel y Filament. |
| Día 2 | Sábado 10 de octubre | Crear el proyecto Laravel y configurar VS Code, `.env`, MySQL y Git. |
| Día 3 | Lunes 12 de octubre | Instalar Filament, configurar `/admin` y la autenticación. |
| Día 4 | Miércoles 14 de octubre | Base de datos, migraciones y modelos de productos, categorías y marcas. |
| Día 5 | Jueves 15 de octubre | CRUD de productos, categorías y marcas, y carga de imágenes. |
| Día 6 | Viernes 16 de octubre | Galería, fichas técnicas PDF, servicios y configuración general. |
| Día 7 | Lunes 19 de octubre | Web pública: Inicio, Nosotros y Contacto. |
| Día 8 | Miércoles 21 de octubre | Catálogo, categorías y página individual de producto. |
| Día 9 | Jueves 22 de octubre | WhatsApp, solicitud de cotización, Soluciones y Marcas. |
| Día 10 | Viernes 23 de octubre | Diseño completo con Bootstrap 5.3 y adaptación responsive. |
| Día 11 | Sábado 24 de octubre | SEO, navegación, validaciones y seguridad. |
| Día 12 | Lunes 26 de octubre | Preparación de producción: VPS, Nginx, MySQL, PHP-FPM, dominio y SSL. |
| Día 13 | Martes 27 de octubre | Despliegue, pruebas finales, correcciones y **LANZAMIENTO DE DIGIGROW**. |

## Reglas de seguimiento

- Las jornadas se identifican como Día 1, Día 2, Día 3 y así sucesivamente.
- Las fechas del calendario se conservan como aparecen en el cronograma aprobado.
- El número del día depende del avance comprobado, no de la fecha actual.
- Si quedan entregables pendientes, se continúa trabajando en el mismo día.
- No se avanza a la siguiente jornada hasta verificar los entregables obligatorios de la actual.
- No se modifican fechas ni entregables sin autorización del usuario.
- Registrar en `ESTADO_PROYECTO.md` los avances comprobados, las verificaciones realizadas y las tareas pendientes.
- No declarar una tarea completada solo porque existan archivos, modelos, tablas o migraciones relacionados con ella.

## Criterio de lanzamiento

El lanzamiento está previsto para el martes 27 de octubre de 2026. Las pruebas finales deben confirmar el funcionamiento de los entregables de la Fase 1 antes de considerar DigiGrow listo para producción.