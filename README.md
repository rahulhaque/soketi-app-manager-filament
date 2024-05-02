# Soketi App Manager 📡

Simple frontend for [Soketi](https://soketi.app/) websocket server with a intuitive user interface. Made with [FilamentPHP](https://filamentphp.com/) and 💕

**Soketi App Manager** provides a user-friendly interface for managing your Soketi websocket applications. You can effortlessly manage multiple websocket applications, streamlining your app management process. The whole setup process is made simpler so that anyone can easily get started with the Soketi websocket server. 🚀 It currently features -
- Dashboard to show realtime server stats and app connections.
- Create, serve, view, edit, delete and search multiple websocket applications.
- Interactive UI for managing application webhooks.
- Interactive UI for managing webhook filters.
- Create and manage multiple users with different roles (Admin/Non-admin).
- Documentation for client and backend integration.
- Light and dark theme.

> Soketi app caching is enabled by default for an hour. Any modification to the app will not be reflected until the cache timeout expires. Adjust the time in any of the 'soketi.json' files you're using by editing the value of `appManager.cache.ttl`.

Support the development with a ⭐ to let others know it worked for you.

I invest a lot of time and effort in open-source. If you like this project, consider supporting me on [ko-fi](https://ko-fi.com/W7W2I1JIV). 🙏

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/W7W2I1JIV)

## Requirements

- PHP^8.1
- Composer^2
- MySQL^8|PostgreSQL^13.3
- Redis^6
- NodeJS^14
- Soketi running with MySQL|PostgreSQL

## Installation

```bash
# Clone or download the repo
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

## Docker Installation

Some considerations -

- By default port `80` is exposed through nginx. Change the `APP_PORT` in `.env` after copying, before running `docker compose up -d`.
- By default nginx is configured to handle websocket requests as well. No need to expose soketi port `6001` for websockets. Use the `APP_PORT` instead.

```bash
# Clone or download the repo
git clone https://github.com/rahulhaque/soketi-app-manager-filament.git

# Go to the directory
cd soketi-app-manager-filament

# Copy .env.docker.example to .env
cp .env.docker.example .env

# Copy soketi.docker.json.example to soketi.docker.json
cp soketi.docker.json.example soketi.docker.json

# Build the image
docker compose build

# Run the application
docker compose up -d

# Drop to application shell
docker compose exec -u soketi soketi-app-manager bash

# Generate application key
php artisan key:generate

# Migrate database
php artisan migrate

# Create the admin user
php artisan make:filament-user

# Logout from shell
exit

# Visit application
http://localhost:APP_PORT

# Stop the application or
docker compose stop

# Stop and remove containers
docker compose down
```

## Screenshots

1. Login
<img title="login" src="screenshots/login.png" width="100%"/>

2. Dashboard
<img title="dashboard" src="screenshots/dashboard.png" width="100%"/>

3. View applications
<img title="view-apps" src="screenshots/view-apps.png" width="100%"/>

4. Edit application
<img title="edit-app" src="screenshots/edit-app.png" width="100%"/>

## Security

If you discover any security related issues, please email rahulhaque07@gmail.com instead of using the issue tracker.

## Credits

- [Rahul Haque](https://github.com/rahulhaque)
- [Soketi](https://soketi.app/)
- [FilamentPHP](https://filamentphp.com/)
- [All Contributors](../../contributors)

## License

GNU General Public License v3.0. See [License File](LICENSE) for more information.
