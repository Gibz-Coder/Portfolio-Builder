# Portfolio Builder

A comprehensive Laravel application for creating professional portfolio websites. Built with Laravel 12, Tailwind CSS, and modern web technologies.

## Features

### 🎯 Core Features
- **User Authentication** - Registration, login, password reset with Laravel Breeze
- **Role-based Access Control** - Admin and User roles with proper authorization
- **Professional Dashboard** - Investment dashboard-inspired interface
- **Public Portfolio Pages** - Beautiful, responsive portfolio websites

### 👤 Portfolio Management
- **Profile Management** - Personal information, bio, contact details, avatar, resume
- **Skills Showcase** - Technical skills with proficiency levels and categories
- **Work Experience** - Professional history with technologies and descriptions
- **Project Portfolio** - Project showcase with images, demos, and GitHub links
- **Services Offered** - Service listings with pricing and features
- **Client Testimonials** - Reviews and ratings from clients
- **Social Media Links** - Connect all social profiles
- **Contact Form** - Direct messaging system for potential clients

### 🛡️ Admin Features
- **User Management** - Create, edit, activate/deactivate users
- **Content Moderation** - Approve testimonials and manage content
- **System Overview** - Monitor platform usage and activity

### 📱 Technical Features
- **Responsive Design** - Mobile-first, works on all devices
- **File Upload System** - Handle avatars, resumes, project images
- **Database Optimization** - Proper relationships and indexing
- **Security** - Authorization policies, CSRF protection, input validation
- **Modern UI** - Tailwind CSS with Font Awesome icons

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- SQLite (default) or MySQL/PostgreSQL

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd portfolio-builder
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   # SQLite (default)
   touch database/database.sqlite
   
   # Run migrations and seeders
   php artisan migrate --seed
   ```

6. **Storage setup**
   ```bash
   php artisan storage:link
   ```

7. **Build assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

8. **Start the server**
   ```bash
   php artisan serve
   ```

## Default Accounts

After running the seeders, you'll have these default accounts:

### Admin Account
- **Email:** admin@portfoliobuilder.com
- **Password:** password
- **Role:** Admin

### Demo User Account
- **Email:** john@example.com
- **Password:** password
- **Role:** User

## Usage

### For Users
1. **Register** or login to your account
2. **Complete your profile** with personal information and avatar
3. **Add your skills** with proficiency levels
4. **Document your experience** and education
5. **Showcase your projects** with images and links
6. **List your services** with pricing
7. **Collect testimonials** from clients
8. **Share your portfolio** with the public URL

### For Admins
1. **Login** with admin credentials
2. **Manage users** - create, edit, activate/deactivate accounts
3. **Monitor content** - review and approve testimonials
4. **System oversight** - track platform usage

## File Structure

```
portfolio-builder/
├── app/
│   ├── Http/Controllers/     # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Policies/            # Authorization policies
│   └── Http/Middleware/     # Custom middleware
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/
│   └── web.php             # Web routes
└── public/
    └── storage/            # Public file storage
```

## Key Models & Relationships

- **User** - Core user model with role-based access
- **Profile** - User profile information (1:1 with User)
- **Skill** - Technical and professional skills (1:Many with User)
- **Experience** - Work experience entries (1:Many with User)
- **Education** - Educational background (1:Many with User)
- **Project** - Portfolio projects (1:Many with User)
- **Service** - Services offered (1:Many with User)
- **Testimonial** - Client testimonials (1:Many with User)
- **Social** - Social media links (1:Many with User)
- **Message** - Contact form messages (1:Many with User)

## Security Features

- **Authentication** - Laravel Breeze with secure session management
- **Authorization** - Policy-based access control for all resources
- **Input Validation** - Comprehensive form validation
- **File Upload Security** - Restricted file types and sizes
- **CSRF Protection** - Built-in Laravel CSRF protection
- **SQL Injection Prevention** - Eloquent ORM with prepared statements

## Customization

### Adding New Portfolio Sections
1. Create a new model and migration
2. Add relationships to the User model
3. Create controller with CRUD operations
4. Add authorization policy
5. Create views for management
6. Update the public portfolio template
7. Add navigation links

### Styling Customization
- Edit `resources/css/app.css` for custom styles
- Modify Tailwind configuration in `tailwind.config.js`
- Update blade templates in `resources/views/`

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, please create an issue in the GitHub repository or contact the development team.

---

**Portfolio Builder** - Create stunning professional portfolios with ease! 🚀