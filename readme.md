Las especificaciones de las apis se encuentran en el archivo \doc\openapi.yaml
Para poder importarlo ingresar al editor Swagger online: https://editor.swagger.io/ y pegar el contenido de ese archivo

Dejamos igualmente la especificación en este archivo:


# API de Letras de Canciones

API para gestionar géneros, canciones y comentarios de música.

**Autores:**
- Julián González
- Email: juliangonzalez122546@gmail.com
- Belén Fernández
- Email: mbelenfernandez9@gmail.com


## Endpoints

### Obtener Género por ID

**Descripción:**
La API `/api/generos/{id}` permite obtener información detallada de un género musical específico mediante su `id_genero`.

**Método HTTP:** `GET`

**Parámetros de la Ruta:**
- `id`: Identificador único del género.

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene los datos del género correspondiente.

---

### Actualizar Género por ID

**Descripción:**
La API `/api/generos/{id}` posibilita la actualización de la descripción de un género musical mediante su `id_genero`. Se deben proporcionar los nuevos datos en el cuerpo de la solicitud.

**Método HTTP:** `PUT`

**Parámetros de la Ruta:**
- `id`: Identificador único del género.

**Respuestas:**
- `200 OK`: La solicitud de actualización fue exitosa, y la respuesta contiene los detalles del género actualizado.

---

### Listar Canciones

**Descripción:**
La API `/api/canciones` se utiliza para obtener una lista paginada de canciones, permitiendo especificar el tamaño de la página (`size`) y el número de página (`page`).

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `page`: Número de página.
- `size`: Tamaño de página.

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene la lista de canciones paginada.

---

### Obtener Canción por ID

**Descripción:**
La API `/api/canciones/{id}` permite obtener información detallada de una canción específica mediante su `id_cancion`.

**Método HTTP:** `GET`

**Parámetros de la Ruta:**
- `id`: Identificador único de la canción.

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene los datos de la canción correspondiente.

---

### Actualizar Canción por ID

**Descripción:**
La API `/api/canciones/{id}` posibilita la actualización de los datos de una canción mediante su `id_cancion`. Se deben proporcionar todos los campos actualizados en el cuerpo de la solicitud.

**Método HTTP:** `PUT`

**Parámetros de la Ruta:**
- `id`: Identificador único de la canción.

**Respuestas:**
- `200 OK`: La solicitud de actualización fue exitosa, y la respuesta contiene los detalles de la canción actualizada.

---

### Obtener Comentario por ID

**Descripción:**
La API `/api/comentarios/{id}` permite obtener información detallada de un comentario específico mediante su `id_comentario`.

**Método HTTP:** `GET`

**Parámetros de la Ruta:**
- `id`: Identificador único del comentario.

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene los datos del comentario correspondiente.

---

### Actualizar Comentario por ID

**Descripción:**
La API `/api/comentarios/{id}` posibilita la actualización de un comentario específico mediante su `id_comentario`. Se deben proporcionar los nuevos datos en el cuerpo de la solicitud.

**Método HTTP:** `PUT`

**Parámetros de la Ruta:**
- `id`: Identificador único del comentario.

**Respuestas:**
- `200 OK`: La solicitud de actualización fue exitosa, y la respuesta contiene los detalles del comentario actualizado.

---

### Crear un Comentario

**Descripción:**
La API `/api/comentarios` permite crear nuevos comentarios asociados a una canción. Se deben proporcionar los datos del comentario en el cuerpo de la solicitud.

**Método HTTP:** `POST`

**Respuestas:**
- `201 Created`: La solicitud de creación fue exitosa, y la respuesta contiene los detalles del nuevo comentario.

---

### Obtener Token de Autenticación

**Descripción:**
La API `/api/auth/token` se utiliza para obtener un token de autenticación. Se deben enviar las credenciales de usuario y contraseña a través de la autorización básica.

**Método HTTP:** `GET`

**Parámetros de la Consulta:**
- `username`: Nombre de usuario para autenticación básica.
- `password`: Contraseña para autenticación básica.

**Respuestas:**
- `200 OK`: La solicitud fue exitosa, y la respuesta contiene el token de autenticación.
  ```json
  {
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
