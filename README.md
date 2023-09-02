# Soketi App Manager

Simple application manager for [Soketi](https://soketi.app/) websocket server with a intuitive user interface. Made with [Filamentphp](https://filamentphp.com/) and 💕

**Soketi App Manager** provides a user-friendly interface for managing your Soketi websocket applications. With this, you can effortlessly **create**, **serve**, **view**, **edit**, **delete** and **search** multiple websocket applications, streamlining your app management process. The whole setup process is made simpler and easier for anyone who wants to try it out.

## Requirements

- PHP^8.1
- Composer^2
- MySQL^8
- Redis^6
- Npm^8

## Installation

```bash
# Clone the repo
git clone https://github.com/rahulhaque/soketi-app-manager-filament.git

# Go to the directory
cd soketi-app-manager-filament

# Copy .env.example to .env
cp .env.example .env

# Install dependencies
composer install

# Generate application key
php artisan key:generate

# Migrate database
php artisan migrate

# Create the admin user
php artisan make:filament-user

# Run the application
php artisan serve

# Install soketi websocket server
npm install -g @soketi/soketi

# Copy soketi.json.example to soketi.json
cp soketi.json.example soketi.json

# Run soketi server
soketi start --config=soketi.json
```

## Screenshots

1. Login
<img title="login" src="https://github.com/rahulhaque/soketi-app-manager-filament/blob/master/screenshots/login.png" width="100%"/>

2. Create application
<img title="create-app" src="https://github.com/rahulhaque/soketi-app-manager-filament/blob/master/screenshots/create-app.png" width="100%"/>

3. View applications
<img title="view-apps" src="https://github.com/rahulhaque/soketi-app-manager-filament/blob/master/screenshots/view-apps.png" width="100%"/>

4. Edit application
<img title="edit-app" src="https://github.com/rahulhaque/soketi-app-manager-filament/blob/master/screenshots/edit-app.png" width="100%"/>

## More Info

Thank you for visiting. This project is solely made for learning purposes. Outcome of my journey of learning [Filamentphp](https://filamentphp.com/). The structure of the project and the code practices may prove useful to new learners who are exploring new technologies.

Spare a ⭐ to keep me motivated. 😃
