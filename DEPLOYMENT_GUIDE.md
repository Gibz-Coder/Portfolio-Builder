# Portfolio Builder Deployment Guide

## Multi-Container LXC Setup

### Container Architecture
- **CT 201**: Reverse Proxy (192.168.100.201)
- **CT 202**: Web Hosting NGINX (192.168.100.202) - **CURRENT CONTAINER**
- **CT 203**: Database Server MySQL (192.168.100.203)
- **CT 204**: Redis Cache (192.168.100.204)
- **CT 205**: Monitoring (Future setup)

### Current Status: ✅ COMPLETED

## Application Configuration

### Environment Settings
- **Application**: Portfolio Builder (Laravel 12)
- **Port**: 8001 (website1)
- **Database**: SQLite (temporary, ready for MySQL migration)
- **Cache**: Database (ready for Redis migration)
- **Assets**: Built and optimized with Vite

### URLs
- **Direct Access**: http://192.168.100.202:8001
- **Through Reverse Proxy**: Will be configured on CT 201

## Reverse Proxy Configuration (CT 201)

### NGINX Configuration for CT 201
```nginx
# /etc/nginx/sites-available/portfolio-builder
server {
    listen 80;
    server_name portfolio.yourdomain.com;  # Replace with your domain
    
    # Proxy headers for Laravel
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
    proxy_set_header X-Forwarded-Host $host;
    proxy_set_header X-Forwarded-Port $server_port;
    
    # Main application
    location / {
        proxy_pass http://192.168.100.202:8001;
        proxy_redirect off;
        proxy_buffering off;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
    
    # Static assets optimization
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        proxy_pass http://192.168.100.202:8001;
        proxy_cache_valid 200 1y;
        add_header Cache-Control "public, immutable";
        expires 1y;
    }
}
```

### SSL Configuration (Optional)
```nginx
# SSL version
server {
    listen 443 ssl http2;
    server_name portfolio.yourdomain.com;
    
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    
    # Same proxy configuration as above
    # ...
}

# Redirect HTTP to HTTPS
server {
    listen 80;
    server_name portfolio.yourdomain.com;
    return 301 https://$server_name$request_uri;
}
```

## Database Migration to MySQL (CT 203)

### Steps to migrate from SQLite to MySQL:
1. **Create database on CT 203**:
   ```sql
   CREATE DATABASE portfolio_builder;
   CREATE USER 'portfolio_user'@'192.168.100.202' IDENTIFIED BY 'secure_password_123';
   GRANT ALL PRIVILEGES ON portfolio_builder.* TO 'portfolio_user'@'192.168.100.202';
   FLUSH PRIVILEGES;
   ```

2. **Update .env file**:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=192.168.100.203
   DB_PORT=3306
   DB_DATABASE=portfolio_builder
   DB_USERNAME=portfolio_user
   DB_PASSWORD=secure_password_123
   ```

3. **Run migrations**:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

## Redis Migration (CT 204)

### Update .env for Redis:
```env
SESSION_DRIVER=redis
CACHE_STORE=redis
QUEUE_CONNECTION=redis
REDIS_HOST=192.168.100.204
```

## Admin Access

### Default Admin Credentials
- **Email**: admin@example.com
- **Password**: password

### Admin Panel Access
- **URL**: http://192.168.100.202:8001/admin/dashboard
- **Features**: User management, system monitoring

## Security Considerations

### Firewall Rules
- **CT 202**: Only allow connections from CT 201 (reverse proxy)
- **CT 203**: Only allow connections from CT 202 (web server)
- **CT 204**: Only allow connections from CT 202 (web server)

### File Permissions
```bash
sudo chown -R www-data:www-data /var/www/website1
sudo chmod -R 755 /var/www/website1
sudo chmod -R 775 storage bootstrap/cache
```

## Monitoring Setup

### Log Files
- **NGINX**: `/var/log/nginx/access.log`, `/var/log/nginx/error.log`
- **Laravel**: `/var/www/website1/storage/logs/laravel.log`
- **PHP-FPM**: `/var/log/php8.4-fpm.log`

### Health Check Endpoint
- **URL**: http://192.168.100.202:8001/up
- **Response**: 200 OK when healthy

## Backup Strategy

### Database Backup (SQLite)
```bash
cp /var/www/website1/database/database.sqlite /backup/portfolio_$(date +%Y%m%d_%H%M%S).sqlite
```

### Application Backup
```bash
tar -czf /backup/portfolio_app_$(date +%Y%m%d_%H%M%S).tar.gz /var/www/website1 --exclude=node_modules --exclude=vendor
```

## Troubleshooting

### Common Issues
1. **500 Error**: Check Laravel logs and file permissions
2. **Asset Loading**: Verify Vite build and NGINX static file handling
3. **Database Connection**: Test connectivity between containers
4. **Redis Connection**: Verify Redis service and network connectivity

### Useful Commands
```bash
# Clear Laravel caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Check NGINX configuration
sudo nginx -t

# Reload NGINX
sudo systemctl reload nginx

# Check application status
curl -I http://192.168.100.202:8001
```
