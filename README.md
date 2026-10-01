# BusGo - AWS Bus Booking Application

BusGo is a beginner-friendly bus booking application built with HTML/CSS/JavaScript, PHP, Apache and MySQL.

## Features

- User registration and login
- Bus listing
- Source/destination search
- Seat availability
- Seat selection
- Booking confirmation
- Booking history
- MySQL database
- AWS EC2 + RDS + Application Load Balancer deployment

## Architecture

```text
Browser
   |
   v
Application Load Balancer
   |
   v
EC2 (Apache + PHP)
   |
   v
Amazon RDS MySQL
```

## Project structure

```text
BusGo/
├── index.html
├── api/
│   ├── db.php
│   ├── buses.php
│   ├── seats.php
│   ├── register.php
│   ├── login.php
│   ├── book.php
│   └── bookings.php
├── database/
│   └── schema.sql
├── config/
│   └── bus-booking-config.example.php
├── .gitignore
└── README.md
```

## Local / EC2 deployment

1. Install Apache, PHP and PHP MySQL support.
2. Copy the application into `/var/www/html/`.
3. Import `database/schema.sql` into MySQL/RDS.
4. Create `/var/www/bus-booking-config.php` using the example configuration.
5. Put the real RDS password only in the server-side configuration file.
6. Start Apache.
7. Test `/api/buses.php`.
8. Open the application through the ALB DNS name.

## Security

Never commit:

- RDS passwords
- `.pem` private keys
- AWS access keys
- secret keys
- production credentials

For the AWS deployment used with this project, RDS port 3306 should be reachable only from the EC2 security group, not from the public internet.

## Important demo note

The browser sends `user_id` to the booking/history endpoints for this beginner project. For production, replace this with PHP sessions or another server-side authentication mechanism so the server determines the authenticated user.
