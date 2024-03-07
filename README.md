# LuxuryServices 💼

LuxuryServices is a platform designed to simulate a professional recruitment consultancy environment, offering services for the recruitment of permanent, contract, and temporary positions. It serves as a learning project to understand the dynamics of matching job seekers with employers effectively.

Visit [LuxuryServices](https://luxuryservices.evgenii.fr/) to access the website.

## Features 🚀

- User authentication system (login, register, password reset by email)
- Job application functionality
- Job offer creation
- Admin panel powered by EasyAdmin for easy management
- Graphical representation of data using Chart.js

## Technologies Used 💻

- Symfony
- EasyAdmin
- Chart.js

## Installation 🛠️

To run this project locally, follow these steps:

1. Clone the repository:

```bash
git clone https://github.com/enypy/LuxuryServices.git
```

2. Install dependencies:

```bash
composer install
```

3. Set up your MAILER_DSN variable:

```bash
nano .env
```

4. Set up your Google Maps API KEY:

```bash
nano templates/home/contact.html.twig
```

5. Run migrations to set up the database:

```bash
php bin/console doctrine:migrations:migrate
```

6. Serve the application:

```bash
symfony serve
```

## Database Diagram 📄

Available on [bdiagram.io](https://dbdiagram.io/d/TP-Luxury-Services-6512b106ffbf5169f083b96c).
