# TPE - API RESTful

En este proyecto realizado para la cátedra de Web 2 de la facultad de Ciencias Exactas de UNICEN se realizó una API REST que permite ver un agente, ver varios agentes con distintas opciones, crear, editar y eliminar agentes. También existe la posibilidad de la Autenticación de usuarios con Tókens. 

## API Endpoints

### Obtener todos los agentes

```http
  GET /api/agentes
```

| Parameter | Type     | Description                | Default |
| :-------- | :------- | :------------------------- |:--------|
| `order` | `string` |  Orden ascendente o descendente | ASC |
| `field` | `string` |  Campo por el cual se ordena | Alias |
| `filterBy` | `string` |  Columna a filtrar (role, race o is_free)| null |
| `filterValue` | `string / number` |  Valor  del campo a mostrar según filtro | null |
| `limit` | `string` |  Cantidad de agentes a mostrar | null |
| `offset` | `string` |  Cantidad de agentes a ocultar | null |

Ejemplo: 
```
curl --location --request GET '/api/agentes?order=desc&field=id&filterBy=Centinela&limit=2&offset=0'
```

### Obtener un agente

```http
  GET /api/agente/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id del agente |

Ejemplo: 
```
curl --location --request GET '/api/agentes/20'
```

### Obtener solamente un campo de un agente por ID

```http
  GET /api/agente/${id}/${subrecurso}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id del agente |
| `subrecurso`      | `string` | **Required**. Role o Alias |

Ejemplo: 
```
curl --location --request GET '/api/agentes/20/alias'
```

### Crear un agente 

```http
  POST /api/agentes
```

#### Request body

Ejemplo:
```json
    curl --location --request POST '/api/agentes' \
--header 'Content-Type: application/json' \
--data-raw '{
    "alias": "Omen",
    "id_role_fk": 3,
    "description": "Un espectro de la memoria, Omen caza entre las sombras, ciega a los enemigos, se transporta a través del campo de batalla y deja que la paranoia los invada mientras intentan descubrir dónde atacará.",
    "agent_img": "https://images.contentstack.io/v3/assets/bltb6530b271fddd0b1/blt4e5af408cc7a87b5/5eb7cdc17bedc8627eff8deb/V_AGENTS_587x900_Omen.png",
    "age": 150,
    "nacionality": "Desconocido",
    "race": "Radiante",
    "is_free": 0,
    "teamwork": 4
}'
```

| Key | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `alias`      | `string` | **Required**. Nombre del agente |
| `id_role_fk`      | `number` | **Required**. ID del rol correspondiente |
| `description`      | `string` | **Required**. Descripción |
| `agent_img`      | `string` | **Required**. Enlace de imagen |
| `age`      | `number` | **Required**. Edad |
| `nacionality`      | `string` | **Required**. Nacionalidad |
| `race`      | `string` | **Required**. Raza humana o radiante |
| `is_free`      | `number` | **Required**. Indica si es gratuito. 0 = no gratis / 1 = gratis |
| `teamwork`      | `number` | **Required**. Índice de trabajo en equipo del 1 al 5  |

### Editar un agente

```http
  PUT /api/agentes/${id}
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id del agente |

#### Request body 

Ejemplo:
```json
    curl --location --request PUT '/api/agentes/21' \
--header 'Content-Type: application/json' \
--data-raw '{
    "alias": "Roberto",
    "id_role_fk": 3,
    "description": "Un espectro de la memoria, Omen caza entre las sombras, ciega a los enemigos, se transporta a través del campo de batalla y deja que la paranoia los invada mientras intentan descubrir dónde atacará.",
    "agent_img": "https://images.contentstack.io/v3/assets/bltb6530b271fddd0b1/blt4e5af408cc7a87b5/5eb7cdc17bedc8627eff8deb/V_AGENTS_587x900_Omen.png",
    "age": 150,
    "nacionality": "Desconocido",
    "race": "Radiante",
    "is_free": 0,
    "teamwork": 4
}'
```

| Key | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `alias`      | `string` | **Required**. Nombre del agente |
| `id_role_fk`      | `number` | **Required**. ID del rol correspondiente |
| `description`      | `string` | **Required**. Descripción |
| `agent_img`      | `string` | **Required**. Enlace de imagen |
| `age`      | `number` | **Required**. Edad |
| `nacionality`      | `string` | **Required**. Nacionalidad |
| `race`      | `string` | **Required**. Raza humana o radiante |
| `is_free`      | `number` | **Required**. Indica si es gratuito. 0 = no gratis / 1 = gratis |
| `teamwork`      | `number` | **Required**. Índice de trabajo en equipo del 1 al 5  |

### Eliminar un agente

```http
  DELETE /api/agentes/${id}
```
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id del agente |

Ejemplo:
```
curl --location --request DELETE '/api/agentes/20'
```