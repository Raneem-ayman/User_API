Endpoint Descriptions:
    1.GET /api/users (Index)

        -Description: Retrieve a list of all users.
        -Authentication: Public (No authentication required).
        -Response:
            HTTP Status: 200 OK
            Body: Array of user objects (ID, name, email).

    2.POST /api/users (Store)

        -Description: Create a new user.
        -Authentication: Public (No authentication required).
        -Request Body:
            Name (string, required): User's name.
            Email (string, required): User's email address.
            Password (string, required): User's password.
        -Response:
            HTTP Status: 201 Created
            Body: Newly created user object (ID, name, email).

    3.GET /api/users/{user} (Show)

        -Description: Retrieve details of a specific user.
        -Authentication: Public (No authentication required).
        -Path Parameter:
            user (integer, required): ID of the user.
        -Response:
            HTTP Status: 200 OK
            Body: User object (ID, name, email).

    4.PUT /api/users/{user} (Update)

        -Description: Update details of a specific user.
        -Authentication: Requires authentication token.
        -Path Parameter:
            user (integer, required): ID of the user to update.
        -Request Body:
            Name (string): Updated user's name.
            Email (string): Updated user's email address.
            Password (string): Updated user's password.
        -Response:
            HTTP Status: 200 OK
            Body: Updated user object (ID, name, email).

    5.DELETE /api/users/{user} (Destroy)

        -Description: Delete a specific user.
        -Authentication: Requires authentication token.
        -Path Parameter:
            user (integer, required): ID of the user to delete.
        -Response:
            HTTP Status: 200 OK
            Body: Success message.

    6.POST /api/sanctum/token (Token)

        -Description: Generate authentication token for user login.
        -Authentication: Public (No authentication required).
        -Request Body:
            Email (string, required): User's email address.
            Password (string, required): User's password.
            Device Name (string, required): Name of the device for which the token is generated.
        -Response:
            HTTP Status: 200 OK
            Body: Token string.

    7. GET /api/posts (Index)
        -Description: Retrieve a list of all posts.
        -Authentication: Public (No authentication required).
        Response:
            HTTP Status: 200 OK
            Body: Array of post objects (ID, title, content).

    8. POST /api/posts (Store)
        -Description: Create a new post.
        -Authentication: Requires authentication token.
        -Request Body:
            title (string, required): Post title.
            content (string, required): Post content.
        -Response:
            HTTP Status: 201 Created
            Body: Newly created post object (ID, title, content).

    9. GET /api/posts/{post} (Show)
        -Description: Retrieve details of a specific post.
        -Authentication: Public (No authentication required).
        -Path Parameter:
            post (integer, required): ID of the post.
        -Response:
            HTTP Status: 200 OK
            Body: Post object (ID, title, content).

    10. PUT /api/posts/{post} (Update)
        -Description: Update details of a specific post.
        -Authentication: Requires authentication token.
        -Path Parameter:
            post (integer, required): ID of the post to update.
        -Request Body:
            title (string): Updated post title.
            content (string): Updated post content.
        -Response:
            HTTP Status: 200 OK
            Body: Updated post object (ID, title, content).

    11. DELETE /api/posts/{post} (Destroy)
        -Description: Delete a specific post.
        -Authentication: Requires authentication token.
        -Path Parameter:
            post (integer, required): ID of the post to delete.
        -Response:
            HTTP Status: 200 OK
            Body: Success message.

Request/Response Formats:
    -Request and response bodies are in JSON format.
    -Requests include required fields for each endpoint.
    -Responses include appropriate HTTP status codes and response bodies with relevant data.

Authentication:
    -Most endpoints require authentication tokens, except for the store, index, and token endpoints.
    -Token authentication is handled via Laravel Sanctum.
    -To obtain a token, send a POST request to /api/sanctum/token with valid user credentials and device name.   

How to Obtain a Token:
    To obtain an authentication token for accessing protected endpoints, follow these steps:

    Send POST Request to Token Endpoint:
    Endpoint: POST /api/sanctum/token
    Request Body:
    {
        "email": "test@example.com",
        "password": "password",
        "device_name": "YourDeviceName"
    }

