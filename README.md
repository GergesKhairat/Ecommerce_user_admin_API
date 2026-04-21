# Ecommerce User Admin API

## Project Overview
The Ecommerce User Admin API provides a back-end solution for managing users in an e-commerce platform. It is designed to facilitate user management tasks such as registration, authentication, profile updates, and administrative controls.

## Features
- User registration and authentication
- Password reset functionality
- User profile management
- Admin controls for user role management 

## Installation Instructions
1. Clone the repository:
   ```bash
   git clone https://github.com/GergesKhairat/Ecommerce_user_admin_API.git
   ```
2. Navigate to the project directory:
   ```bash
   cd Ecommerce_user_admin_API
   ```
3. Install the required dependencies:
   ```bash
   npm install
   ```
4. Configure your environment variables as needed in a `.env` file.

## API Endpoints
### User Registration
- **POST** `/api/users/register`
  - **Description**: Registers a new user.
  - **Request Body**: 
    ```json
    {
      "username": "string",
      "email": "string",
      "password": "string"
    }
    ```

### User Login
- **POST** `/api/users/login`
  - **Description**: Authenticates a user.
  - **Request Body**: 
    ```json
    {
      "email": "string",
      "password": "string"
    }
    ```

### Password Reset
- **POST** `/api/users/reset-password`
  - **Description**: Sends a password reset link to the user's email.
  - **Request Body**: 
    ```json
    {
      "email": "string"
    }
    ```

### Update User Profile
- **PUT** `/api/users/profile`
  - **Description**: Updates user profile information.
  - **Request Body**: 
    ```json
    {
      "username": "new_string",
      "email": "new_string"
    }
    ```

## Usage Guide
To use the API, ensure that you're sending requests to the correct endpoints as described above. You can use tools like Postman or CURL to test the API functionality.

Be sure to include necessary authentication tokens in your requests if required.