# 🏘️ Bayanihan Community Management System

A comprehensive Laravel-based community management system designed for barangay (village) administration, featuring real-time notifications, benefit management, contribution tracking, and multi-role user management.

## 🌟 Features

### 👥 **Multi-Role System**
- **Admin**: Full system control and oversight
- **Treasurer**: Barangay-level financial management
- **Member**: Community member with access to benefits and contributions

### 🔔 **Real-time Notifications**
- Instant notifications for new announcements
- Benefit status change alerts
- Contribution validation notifications
- Mark as read functionality
- Toast notifications for immediate feedback

### 📢 **Announcement System**
- Admin announcements for all users
- Treasurer announcements for specific barangay members
- Priority-based announcement system
- Real-time broadcasting

### 💰 **Benefit Management**
- Multiple benefit types (Hospitalization, Burial, Animal Bite, etc.)
- Application tracking with status updates
- Document upload support
- Approval workflow (Treasurer → Admin)
- Real-time status notifications

### 💳 **Contribution Tracking**
- Weekly savings tracking
- Special contributions
- Penalty management
- Proof of payment uploads
- Validation workflow

### 📊 **Reporting & Analytics**
- Financial reports
- Member statistics
- Contribution summaries
- Benefit distribution reports

### 📱 **Responsive Design**
- Mobile-first approach
- Cross-device compatibility
- Touch-friendly interface
- Adaptive layouts

## 🛠️ Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: MySQL
- **Real-time**: Pusher WebSockets
- **Authentication**: Laravel Auth
- **File Storage**: Laravel Storage

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- Node.js & NPM (for asset compilation)
- Web server (Apache/Nginx)

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/crisvin03/samaritan-bayanihan.git
cd samaritan-bayanihan
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Update your `.env` file with database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bayanihan_db
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
php artisan db:seed
```

### 6. Compile Assets
```bash
npm run build
```

### 7. Start the Server
```bash
php artisan serve
```

## 🔧 Configuration

### Broadcasting Setup
For real-time notifications, configure Pusher in your `.env`:
```env
BROADCAST_CONNECTION=pusher
PUSHER_APP_ID=your_app_id
PUSHER_APP_KEY=your_app_key
PUSHER_APP_SECRET=your_app_secret
PUSHER_APP_CLUSTER=your_cluster
```

### File Storage
Configure file storage in `config/filesystems.php` for document uploads.

## 👤 Default Users

After running migrations and seeders, you'll have:

- **Admin User**: Full system access
- **Treasurer Users**: Barangay-specific access
- **Member Users**: Community members

## 📁 Project Structure

```
app/
├── Events/                 # Real-time event broadcasting
├── Http/Controllers/       # Application controllers
│   ├── Admin/            # Admin-specific controllers
│   ├── Member/           # Member-specific controllers
│   └── Treasurer/        # Treasurer-specific controllers
├── Models/               # Eloquent models
├── Services/            # Business logic services
└── Providers/           # Service providers

resources/
├── views/               # Blade templates
│   ├── admin/          # Admin interface
│   ├── member/         # Member interface
│   └── treasurer/      # Treasurer interface
└── css/                # Stylesheets

database/
├── migrations/          # Database migrations
└── seeders/           # Database seeders
```

## 🔐 User Roles & Permissions

### Admin
- Manage all users and roles
- Create system-wide announcements
- Approve/reject benefit applications
- Validate contributions
- Access all reports and analytics

### Treasurer
- Manage barangay members
- Create barangay-specific announcements
- Forward benefit applications to admin
- Record and validate contributions
- Generate barangay reports

### Member
- View announcements
- Apply for benefits
- Submit contributions
- Track application status
- View personal dashboard

## 🔔 Notification System

The system includes a comprehensive notification system:

- **Real-time Broadcasting**: Using Pusher WebSockets
- **Event-driven**: Automatic notifications on status changes
- **Persistent Storage**: All notifications stored in database
- **Mark as Read**: User can mark notifications as read
- **Toast Notifications**: Immediate visual feedback

### Notification Types
- New announcements
- Benefit status changes
- Contribution validation updates
- System alerts

## 📊 Database Schema

### Core Tables
- `users` - User accounts with role-based access
- `announcements` - System and barangay announcements
- `benefits` - Benefit applications and tracking
- `contributions` - Member contributions and payments
- `notifications` - Real-time notification storage

### Relationships
- Users have polymorphic notifications
- Benefits belong to users
- Contributions belong to users
- Announcements have creators

## 🧪 Testing

### Test Notification System
Visit `/test-notification` to test the real-time notification system.

### Manual Testing
1. Create an announcement as admin
2. Check member notifications
3. Apply for a benefit
4. Track status changes
5. Submit a contribution
6. Verify validation workflow

## 🚀 Deployment

### Production Checklist
- [ ] Update `.env` with production values
- [ ] Configure web server (Apache/Nginx)
- [ ] Set up SSL certificate
- [ ] Configure Pusher for production
- [ ] Set up database backups
- [ ] Configure file storage
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
BROADCAST_CONNECTION=pusher
PUSHER_APP_ID=your_production_app_id
PUSHER_APP_KEY=your_production_app_key
PUSHER_APP_SECRET=your_production_app_secret
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

For support and questions:
- Create an issue on GitHub
- Contact the development team
- Check the documentation

## 🎯 Roadmap

### Upcoming Features
- [ ] Mobile app integration
- [ ] Advanced reporting dashboard
- [ ] Email notifications
- [ ] SMS integration
- [ ] Multi-language support
- [ ] API endpoints for mobile apps

---

**Built with ❤️ for community management**