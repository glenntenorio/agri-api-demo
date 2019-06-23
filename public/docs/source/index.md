---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#Fields
<!-- START_d8bab808dfa83f6a84db0157c26ecdb7 -->
## Show a field

Display the specified Field.

> Example request:

```bash
curl -X GET -G "/fields/1" 
```
```javascript
const url = new URL("/fields/1");

    let params = {
            "api_token": "placeat",
            "id": "porro",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "user_id": 1,
    "name": "field1",
    "crop_type": "Strawberries",
    "area": "150.00",
    "created_at": "2019-06-22 13:36:07",
    "updated_at": "2019-06-22 13:36:07"
}
```

### HTTP Request
`GET /fields/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  optional  | Field required ID

<!-- END_d8bab808dfa83f6a84db0157c26ecdb7 -->

<!-- START_d3342517f37739fbef76679ec59da4ed -->
## Show all fields

Display a listing of the Fields.

> Example request:

```bash
curl -X GET -G "/fields" 
```
```javascript
const url = new URL("/fields");

    let params = {
            "api_token": "repudiandae",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[
    {
        "id": 1,
        "user_id": 1,
        "name": "field1",
        "crop_type": "Strawberries",
        "area": "150.00",
        "created_at": "2019-06-22 13:36:07",
        "updated_at": "2019-06-22 13:36:07"
    }
]
```

### HTTP Request
`GET /fields`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token

<!-- END_d3342517f37739fbef76679ec59da4ed -->

<!-- START_e398e8312685602a7a3a60c9d5598d70 -->
## Store a field

Store a newly created Field in storage.

> Example request:

```bash
curl -X POST "/fields" \
    -H "Content-Type: application/json" \
    -d '{"name":"adipisci","crop_type":"voluptatem","area":"doloribus"}'

```
```javascript
const url = new URL("/fields");

    let params = {
            "api_token": "autem",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "adipisci",
    "crop_type": "voluptatem",
    "area": "doloribus"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 1,
    "user_id": 1,
    "name": "field1",
    "crop_type": "Strawberries",
    "area": "150.00",
    "created_at": "2019-06-22 13:36:07",
    "updated_at": "2019-06-22 13:36:07"
}
```
> Example response (400):

```json
{
    "error": "validation_error",
    "message": "The given data was invalid.",
    "errors": {
        "area": [
            "The area must be a number."
        ]
    }
}
```

### HTTP Request
`POST /fields`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Name of field.
    crop_type | string |  required  | Type of crop selected from column enum.
    area | decimal |  required  | Land area.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token

<!-- END_e398e8312685602a7a3a60c9d5598d70 -->

<!-- START_6d34d519426ffb93ddb7a9575e7f3de5 -->
## Update a field

Update the specified Field in storage.

> Example request:

```bash
curl -X PUT "/fields/1" \
    -H "Content-Type: application/json" \
    -d '{"name":"sit","crop_type":"corrupti","area":"in"}'

```
```javascript
const url = new URL("/fields/1");

    let params = {
            "api_token": "deleniti",
            "id": "itaque",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "sit",
    "crop_type": "corrupti",
    "area": "in"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "user_id": 1,
    "name": "field1",
    "crop_type": "Strawberries",
    "area": "150.00",
    "created_at": "2019-06-22 13:36:07",
    "updated_at": "2019-06-22 13:36:07"
}
```
> Example response (400):

```json
{
    "error": "validation_error",
    "message": "The given data was invalid.",
    "errors": {
        "area": [
            "The area must be a number."
        ]
    }
}
```
> Example response (401):

```json
{}
```
> Example response (500):

```json
{}
```

### HTTP Request
`PUT /fields/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Name of field.
    crop_type | string |  required  | Type of crop selected from column enum.
    area | decimal |  required  | Land area.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Field ID

<!-- END_6d34d519426ffb93ddb7a9575e7f3de5 -->

<!-- START_89598781a3dbc0ac151e5728936f3be0 -->
## Remove a field

Remove the specified Field from storage.

> Example request:

```bash
curl -X DELETE "/fields/1" 
```
```javascript
const url = new URL("/fields/1");

    let params = {
            "api_token": "esse",
            "id": "laborum",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "message": "field_deleted"
}
```
> Example response (401):

```json
{}
```
> Example response (500):

```json
{}
```

### HTTP Request
`DELETE /fields/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Field ID

<!-- END_89598781a3dbc0ac151e5728936f3be0 -->

#Processed Fields
<!-- START_3874a1271c44b8080ff6eb521a778d8d -->
## Create report

Create report of processed fields with summary of processed areas grouped by culture.
HTTP get parameters:
field_name [e.g. field1],
culture [e.g. Wheat],
date_from [e.g. 2019-01-01],
date_to [e.g. 2019-01-01]

> Example request:

```bash
curl -X GET -G "/processed-fields/report" 
```
```javascript
const url = new URL("/processed-fields/report");

    let params = {
            "api_token": "nulla",
            "field_name": "voluptatem",
            "culture": "rerum",
            "date_from": "fugiat",
            "date_to": "rem",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "summary": [
        {
            "culture": "Wheat",
            "total_area_processed": "299.00"
        }
    ],
    "processed_fields": [
        {
            "id": 2,
            "field_name": "field2",
            "culture": "Wheat",
            "processed_at": "2019-06-22 00:00:00",
            "tractor_name": "My Tractor 2",
            "area_processed": "150.00"
        },
        {
            "id": 11,
            "field_name": "field2",
            "culture": "Wheat",
            "processed_at": "2019-06-22 00:00:00",
            "tractor_name": "My Tractor 2",
            "area_processed": "149.00"
        }
    ]
}
```

### HTTP Request
`GET /processed-fields/report`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    field_name |  optional  | Field name for filtering
    culture |  optional  | Culture/Crop Type for filtering
    date_from |  optional  | Date from for filtering
    date_to |  optional  | Date to for filtering

<!-- END_3874a1271c44b8080ff6eb521a778d8d -->

<!-- START_00506aff69fd4b655ec4b51c01403934 -->
## Approve a processed field

Approve the specified processed field by the administrator/supervisor

> Example request:

```bash
curl -X GET -G "/processed-fields/approve/1" 
```
```javascript
const url = new URL("/processed-fields/approve/1");

    let params = {
            "api_token": "eum",
            "id": "animi",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "user_id": 1,
    "tractor_id": 1,
    "field_id": 1,
    "processed_at": "2019-06-20 00:00:00",
    "approved_by_user_id": 1,
    "approved_at": "2019-06-22 00:00:00",
    "area_processed": "149.00",
    "created_at": "2019-06-22 13:55:35",
    "updated_at": "2019-06-22 14:08:47"
}
```
> Example response (401):

```json
{}
```
> Example response (500):

```json
{}
```

### HTTP Request
`GET /processed-fields/approve/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Processed Field ID

<!-- END_00506aff69fd4b655ec4b51c01403934 -->

<!-- START_be88a78d7dfaf135aa7c98cb466f4c28 -->
## Show a processed field

Display the specified processed field.

> Example request:

```bash
curl -X GET -G "/processed-fields/1" 
```
```javascript
const url = new URL("/processed-fields/1");

    let params = {
            "api_token": "dolorum",
            "id": "recusandae",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "user_id": 1,
    "tractor_id": 1,
    "field_id": 1,
    "processed_at": "2019-06-20 00:00:00",
    "approved_by_user_id": null,
    "approved_at": null,
    "area_processed": "149.00",
    "created_at": "2019-06-22 13:55:35",
    "updated_at": "2019-06-22 14:08:47"
}
```

### HTTP Request
`GET /processed-fields/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Processed Field ID

<!-- END_be88a78d7dfaf135aa7c98cb466f4c28 -->

<!-- START_f7f62151fbbb94c8d8f8875823cea316 -->
## Show all processed fields

Display a listing of the processed fields.

> Example request:

```bash
curl -X GET -G "/processed-fields" 
```
```javascript
const url = new URL("/processed-fields");

    let params = {
            "api_token": "enim",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[
    {
        "id": 1,
        "user_id": 1,
        "tractor_id": 1,
        "field_id": 1,
        "processed_at": "2019-06-20 00:00:00",
        "approved_by_user_id": 1,
        "approved_at": "2019-06-22 00:00:00",
        "area_processed": "149.00",
        "created_at": "2019-06-22 13:55:35",
        "updated_at": "2019-06-22 14:08:47"
    }
]
```

### HTTP Request
`GET /processed-fields`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token

<!-- END_f7f62151fbbb94c8d8f8875823cea316 -->

<!-- START_9c40308a8d1d65fe17f5749db91723fb -->
## Store a processed field

Store a newly created processed field in storage.

> Example request:

```bash
curl -X POST "/processed-fields" \
    -H "Content-Type: application/json" \
    -d '{"tractor_id":12,"field_id":1,"area_processed":8,"processed_at":"tenetur"}'

```
```javascript
const url = new URL("/processed-fields");

    let params = {
            "api_token": "incidunt",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "tractor_id": 12,
    "field_id": 1,
    "area_processed": 8,
    "processed_at": "tenetur"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 1,
    "user_id": 1,
    "tractor_id": 1,
    "field_id": 1,
    "processed_at": "2019-06-20 00:00:00",
    "area_processed": "149.00",
    "created_at": "2019-06-22 13:55:35",
    "updated_at": "2019-06-22 14:08:47"
}
```
> Example response (400):

```json
{
    "error": "validation_error",
    "message": "The given data was invalid.",
    "errors": {
        "processed_area": [
            "The area must be a number."
        ]
    }
}
```

### HTTP Request
`POST /processed-fields`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    tractor_id | integer |  required  | Tractor ID.
    field_id | integer |  required  | Field ID.
    area_processed | integer |  required  | Processed land area which is not greater than the selected field.
    processed_at | timestamp |  required  | Timestamp of processing.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token

<!-- END_9c40308a8d1d65fe17f5749db91723fb -->

<!-- START_c6f73cc3938773afe3d22ce53d9d0daa -->
## Update a processed field

Update the specified processed field in storage.

> Example request:

```bash
curl -X PUT "/processed-fields/1" \
    -H "Content-Type: application/json" \
    -d '{"tractor_id":12,"field_id":6,"area_processed":14,"processed_at":"ut"}'

```
```javascript
const url = new URL("/processed-fields/1");

    let params = {
            "api_token": "sint",
            "id": "eligendi",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "tractor_id": 12,
    "field_id": 6,
    "area_processed": 14,
    "processed_at": "ut"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "user_id": 1,
    "tractor_id": 1,
    "field_id": 1,
    "processed_at": "2019-06-20 00:00:00",
    "approved_by_user_id": null,
    "approved_at": null,
    "area_processed": "149.00",
    "created_at": "2019-06-22 13:55:35",
    "updated_at": "2019-06-22 14:08:47"
}
```
> Example response (400):

```json
{
    "error": "validation_error",
    "message": "The given data was invalid.",
    "errors": {
        "processed_area": [
            "The area must be a number."
        ]
    }
}
```
> Example response (401):

```json
{}
```
> Example response (500):

```json
{}
```

### HTTP Request
`PUT /processed-fields/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    tractor_id | integer |  required  | Tractor ID.
    field_id | integer |  required  | Field ID.
    area_processed | integer |  required  | Processed land area which is not greater than the selected field.
    processed_at | timestamp |  required  | Timestamp of processing.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Processed Field ID

<!-- END_c6f73cc3938773afe3d22ce53d9d0daa -->

<!-- START_66845f1ad809cae30d15367967ad8b34 -->
## Remove a processed field

Remove the specified processed field from storage.

> Example request:

```bash
curl -X DELETE "/processed-fields/1" 
```
```javascript
const url = new URL("/processed-fields/1");

    let params = {
            "api_token": "laudantium",
            "id": "est",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "message": "processed_field_deleted"
}
```
> Example response (401):

```json
{}
```
> Example response (500):

```json
{}
```

### HTTP Request
`DELETE /processed-fields/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Processed Field ID

<!-- END_66845f1ad809cae30d15367967ad8b34 -->

#Tractors
<!-- START_28c142bf9c75ae23ed5c51865d2239ad -->
## Show a tractor

Display the specified Tractor.

> Example request:

```bash
curl -X GET -G "/tractors/1" 
```
```javascript
const url = new URL("/tractors/1");

    let params = {
            "api_token": "maxime",
            "id": "voluptates",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "user_id": 1,
    "name": "tractor1",
    "created_at": "2019-06-22 13:36:07",
    "updated_at": "2019-06-22 13:36:07"
}
```

### HTTP Request
`GET /tractors/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Tractor ID

<!-- END_28c142bf9c75ae23ed5c51865d2239ad -->

<!-- START_08139a8f00ad9269eabdd8b2ab11d9ab -->
## Show all tractors

Display a listing of the Tractor.

> Example request:

```bash
curl -X GET -G "/tractors" 
```
```javascript
const url = new URL("/tractors");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
[
    {
        "id": 1,
        "user_id": 1,
        "name": "tractor1",
        "created_at": "2019-06-22 13:36:07",
        "updated_at": "2019-06-22 13:36:07"
    }
]
```

### HTTP Request
`GET /tractors`


<!-- END_08139a8f00ad9269eabdd8b2ab11d9ab -->

<!-- START_5a51017d27a519d0123e5e4165e30be3 -->
## Store a tractor

Store a newly created Tractor in storage.

> Example request:

```bash
curl -X POST "/tractors" \
    -H "Content-Type: application/json" \
    -d '{"name":"officiis"}'

```
```javascript
const url = new URL("/tractors");

    let params = {
            "api_token": "reprehenderit",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "officiis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "id": 1,
    "user_id": 1,
    "name": "tractor1",
    "created_at": "2019-06-22 13:36:07",
    "updated_at": "2019-06-22 13:36:07"
}
```
> Example response (400):

```json
{
    "error": "validation_error",
    "message": "The given data was invalid.",
    "errors": {
        "name": [
            "The name is required."
        ]
    }
}
```

### HTTP Request
`POST /tractors`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Name of tractor.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token

<!-- END_5a51017d27a519d0123e5e4165e30be3 -->

<!-- START_667fc3f867d52f1ef2f74da35874a4dc -->
## Update a field

Update the specified Tractor in storage.

> Example request:

```bash
curl -X PUT "/tractors/1" \
    -H "Content-Type: application/json" \
    -d '{"name":"cupiditate"}'

```
```javascript
const url = new URL("/tractors/1");

    let params = {
            "api_token": "enim",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "cupiditate"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "id": 1,
    "user_id": 1,
    "name": "tractor1",
    "created_at": "2019-06-22 13:36:07",
    "updated_at": "2019-06-22 13:36:07"
}
```
> Example response (400):

```json
{
    "error": "validation_error",
    "message": "The given data was invalid.",
    "errors": {
        "name": [
            "The name is required."
        ]
    }
}
```
> Example response (401):

```json
{}
```
> Example response (500):

```json
{}
```

### HTTP Request
`PUT /tractors/{id}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Name of tractor.
#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token

<!-- END_667fc3f867d52f1ef2f74da35874a4dc -->

<!-- START_856f30dc50b92c5e94684ac95208af03 -->
## Remove a tractor

Remove the specified Tractor from storage.

> Example request:

```bash
curl -X DELETE "/tractors/1" 
```
```javascript
const url = new URL("/tractors/1");

    let params = {
            "api_token": "similique",
            "id": "ipsa",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "message": "tractor_deleted"
}
```
> Example response (401):

```json
{}
```
> Example response (500):

```json
{}
```

### HTTP Request
`DELETE /tractors/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    api_token |  required  | API Token
    id |  required  | Tractor ID

<!-- END_856f30dc50b92c5e94684ac95208af03 -->

#Users
<!-- START_f802bd30160de315902944f0b90d0b4e -->
## Authenticate user

Authenticate user using email address and password. Returns an api token for api authorization.

> Example request:

```bash
curl -X GET -G "/login" 
```
```javascript
const url = new URL("/login");

    let params = {
            "email": "et",
            "password": "dolor",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "api_token": "dkZEMWo1VFVuanhKejJobzF4VmVSZWNNWlZMdERvekl4MFFjMEtoNQ=="
}
```
> Example response (401):

```json
{
    "error": "login_failed"
}
```

### HTTP Request
`GET /login`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    email |  optional  | User's email address.
    password |  optional  | User's password.

<!-- END_f802bd30160de315902944f0b90d0b4e -->


