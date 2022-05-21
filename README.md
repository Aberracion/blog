## Blog

# Uso
'/' Para mostrar el listado de los post
'/:id' Para ver un post en concreto

Api para post: '/api/post' 

Campos del json:

author_name: Nombre del autor

subjet: Cabecera del post

body: Cuerpo del post


Api para el get: '/api/post/:id'

Ejemplo del json:
{
  "author_name": "Autor",
  "subject": "Cabecera",
  "body": "Cuerpo"
}

# Mejoras pendientes

1.- Autenticación en la web.

2.- Que el autor se guarde a partir del usuario que ha accedido

3.- Mocks en los tests

4.- Mejora en las vistas



