# Blood Donor Management System

A comprehensive web application designed to connect blood donors with recipients and blood banks efficiently.

## 🌟 Features

- User registration and authentication (Donors, Recipients, and Blood Banks)
- Search for donors by blood type and location
- Blood bank directory with available blood units
- Request blood donations
- User profiles with donation history
- Interactive map for locating nearby blood banks
- Responsive design for all devices

## 🛠️ Technologies Used

- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap
- **Backend:** PHP
- **Database:** MySQL
- **APIs:** Google Maps API (for location services)
- **Server:** XAMPP (Apache, MySQL)

## 🚀 Getting Started

### Prerequisites

- XAMPP/WAMP/LAMP server
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web browser (Chrome, Firefox, Safari, or Edge)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/PratikshaHS/Blood-Donor-Website.git
   ```

2. Move the project to your web server's root directory (e.g., `htdocs` or `www`)

3. Import the database:
   - Open phpMyAdmin
   - Create a new database named `blood_bank`
   - Import the `database/blood_bank.sql` file

4. Configure database connection:
   - Open `includes/config.php`
   - Update the database credentials if needed

5. Start your local server and access the application through your web browser

## 📂 Project Structure

```
bloodBankProject/
├── assets/           # Static files (images, icons, etc.)
├── css/              # Stylesheets
├── includes/         # PHP includes (header, footer, config, etc.)
├── js/               # JavaScript files
├── admin/            # Admin panel
├── donor/            # Donor-specific pages
├── recipient/        # Recipient-specific pages
├── bloodbank/        # Blood bank management
├── database/         # Database schema and data
├── index.php         # Homepage
└── README.md         # Project documentation
```

## 🔒 Security

- Password hashing using PHP's `password_hash()`
- Prepared statements to prevent SQL injection
- Input validation and sanitization
- Session management

## 🤝 Contributing

Contributions are welcome! Please read our [contributing guidelines](CONTRIBUTING.md) before submitting pull requests.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- Thanks to all the blood donors who make a difference in people's lives
- Open source community for the amazing tools and libraries

## 📧 Contact

For any queries or support, please contact pratikshahsamant@gmail.com or open an issue on GitHub.
