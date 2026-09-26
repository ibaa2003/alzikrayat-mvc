# Alzikrayat - Photo Sharing Application

Alzikrayat is a dynamic photo sharing web application built using PHP and a manually implemented MVC architecture.

## Technologies

- PHP
- MySQL / MariaDB
- HTML5
- CSS3
- Bootstrap
- JavaScript
- Git and GitHub

## Architecture

The application follows the MVC pattern:

- Models handle database operations.
- Views handle the user interface.
- Controllers handle application logic.
- Router handles URL routing.
- Database layer manages the database connection.

## Main Features

- User registration and login
- Secure password hashing
- Session-based authentication
- Last login cookie
- Photo upload
- Photo details
- Multiple photo layouts
- Comments
- Photo deletion with ownership verification
- Comment deletion
- CSRF protection
- Input validation
- Responsive Bootstrap interface

## Project Structure

```text
alzikrayat_mvc/
├── config/
├── controllers/
├── core/
├── database/
├── models/
├── public/
├── routes/
└── views/
