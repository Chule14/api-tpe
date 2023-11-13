# **Criptonoticias API**

### - Descripción
Esta API tiene como proposito acceder a un sistema de Noticias e Informacion Digital relacionado al mundo Cripto.

*Aclaraciones:* 

- La dirección base de la API es la siguiente:

    - **{ruta_servidor_apache}/api**


------------


### - Requerimientos
Contar con la base de datos descripta en los siguientes archivos:
(Ya hay noticias creadas y secciones para que pueda hacer las pruebas.)
- [*Ver archivo SQL*](./app/database/db.sql)
- [*Ver diagrama DER*](.diagrama.png)

------------

### - Endpoints
    
- #### Noticias

    *Cada noticia se listara de la siguiente forma:*
            
    ```json
        {
            "id": 1,
            "titulo": "El mundo revolucionario de las criptos",
            "subtitulo": "Enterate de lo sucedido en las ultimas horas",
            "descripcion": "Las criptomonedas mas buscadas del mercado",
            "id_seccion": 4,
            "imagen": "url_imagen.png",
            "tipo": "Inversiones",
        }
    ```
    #####  - GET: /noticias
    - Este endpoint devuleve un Array con las diferentes noticias cargadas en la base de datos.
    
    ##### - GET: /noticias/:ID
    - Este Endpoint devuelve una noticia especifica buscada por identificador.

    ##### - POST: /noticias
    - Este endpoint recibe un **formData** en el body del **HTTP Request** del siguiente formato:

        /*
        Los únicos campos necesarios para crear/editar exitosamente una noticia son todos, no se puede prescindir de ninguno.
        */
        
            "titulo": "El mundo revolucionario de las criptos" (Text),
            "subtitulo": "Enterate de lo sucedido en las ultimas horas" (Text),
            "descripcion": "Las criptomonedas mas buscadas del mercado" (Text),
            "id_seccion": "4" (Text),
            "imagen": "url_imagen.png", (Tipo File)

        La respuesta incluirá un mensaje si la creacion fue exitosa o un mensaje de error dentro un objeto.

    ##### - PUT: /noticias/:ID 
    - Este endpoint recibe un JSON con la siguiente estructura
    ```json
        {
            "titulo": "El mundo revolucionario de las criptos",
            "subtitulo": "Enterate de lo sucedido en las ultimas horas",
            "descripcion": "Las criptomonedas mas buscadas del mercado",
            "id_seccion": 4,
        }
    ```
    No requiere del campo **"imagen"** y no debe ser un formData, ya que no se puede modificar la imagen de una noticia.

    ##### - DELETE: /noticias/:ID
    - Este endpoint debe devolver un mensaje de exito si se logra eliminar correctamente la noticia o un mensaje de error.

- #### Secciones

    *Cada seccion se listara de esta manera:*
        
    ```json
        {
            "id": "N° de id",
            "tipo": "Tipo de Seccion",
        }
    ```

    ##### - GET: /secciones
    - Este Endpoint devuelve un array que contiene las diferentes secciones
        
    ##### - GET: /secciones/:ID
    - Este Endpoint devuelve un objeto con la informacion de la seccion a obtener.


    ##### - POST: /secciones
    - Este Endpoint crea una nueva seccion a partir de un tipo enviado en un JSON
        ```json
         {
             "tipo": "Seccion a crear", 
         }
         ```

        Dentro de **"data"** se devolverá la canción creada en el mismo formato.

    ##### - PUT: /secciones/:ID 
    - Este Endpoint permite editar una seccion ya creada, debes enviar un JSON Igual anterior solo que en el parametro debes indicar el identificar de la seccion a modificar.
        
    - ***Aclaración**: se deben respetar los **campos obligatorios***.
   
    ##### - DELETE: /secciones/:ID
    - Este Endpoint elimina la seccion ya creada mediante el parametro ID, es importante enviar.


    

- #### Parámetros de ordenamiento:
    Al solicitar una lista de entidades ya sea de noticias o secciones podemos usar los siguientes parametros.

    - **?sort_by** : Este parámetro recibe un string que **debe corresponder** con uno de los **campos de la entidad solicitada**. (Obligatorio)

    - **?order** : Este parámetro recibe un tipo de ordenamiento deben se ASC o DESC (Obligatorio)

    Cuestion una URL de consulta deberia quedarnos asi: http://localhost/(Nombre Carpeta)/api/noticias/?sort=Titulo&order=ASC
    En caso de que no se cumpla o se esten enviando erroneamente los parametros se mostraran las ordenes sin ningun ordenamiento.

- #### Parámetros de filtrado:
    Al solicitar una lista de entidades ya sea de noticias o secciones nos permite filtrar por los siguientes parametros.

    - **?filterBy** : Este parámetro recibe un string que **debe corresponder** con uno de los **campos de la entidad solicitada**. (Obligatorio)

    - **?filterValue** : Este parámetro recibe el valor a buscar especificamente dentro de ese campo (Obligatorio).

    Cuestion una URL de consulta deberia quedarnos asi: http://localhost/(Nombre Carpeta)/api/seccion/?filterBy=Tipo&filterValue=Inversiones
    En caso de que no se cumpla o se esten enviando erroneamente los parametros se mostraran las ordenes sin ningun filtro.

    - **titleContains** : Este parametro es independiente de los demas y sirve para filtrar noticias por un titulo que contenga el valor enviado. (Opcional)

    Cuestion una URL de consulta deberia quedarnos asi: http://localhost/(Nombre Carpeta)/api/noticias/titleContains=Criptos
    En caso de que no se cumpla o se esten enviando erroneamente los parametros se mostraran las ordenes sin ningun filtro.

