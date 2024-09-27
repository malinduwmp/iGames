# iGames (infinity_Games)

![iGames Logo](resources/logo.png)

## Overview

iGames (infinity_Games) is a feature-rich web application built using modern web development technologies. It is designed to offer users a smooth and dynamic gaming platform experience. This project is powered by a PHP backend, a MySQL database, and is styled using Bootstrap 5. JavaScript, HTML, and CSS bring the interface to life, while APIs like Google and WhatsApp add additional functionality.

## Features

- **Responsive UI:** Designed with Bootstrap 5 for seamless responsiveness across devices.
- **Database:** MySQL used to store user data, game stats, and other information.
- **API Integration:** Integrated with Google API and WhatsApp API for added functionalities.
- **Special MySQL Connection for Mac:** Includes a unique MySQL connection file tailored for MacBook users to handle database connections efficiently.
- **Interactive UI:** Dynamic and interactive elements using JavaScript.

## Technologies Used

- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
- **APIs:** Google API, WhatsApp API
- **Custom Mac Support:** Special MySQL connection script for MacBook users

## Installation

### Prerequisites

- **PHP** (version 7.4 or higher)
- **MySQL** (version 5.7 or higher)
- **Composer** (for managing PHP dependencies)
- **npm** (optional, for frontend dependencies)

### Steps

1. Clone the repository:
    ```bash
    git clone https://github.com/malinduwmp/iGames.git
    cd iGames
    ```

2. Set up the database:
    - Import the provided SQL schema located in `repo/database/schema.sql` into your MySQL database.
    - Create a `.env` file based on the `.env.example` file and configure your database credentials.

3. Install dependencies:
    ```bash
    composer install
    ```

4. For Mac users:
    - Use the special MySQL connection script in `repo/mysql/mac_mysql_connection.php` to ensure proper database connectivity.

5. Start the PHP development server:
    ```bash
    php -S localhost:8000
    ```

6. Access the application by visiting `http://localhost:8000` in your browser.

## Usage

1. **User Registration/Login:** Users can sign up, log in, and manage their profiles.
2. **Game Play:** Enjoy a variety of games available in the platform.
3. **APIs:** Use the integrated Google and WhatsApp APIs for enhanced communication and gameplay features.

## Folder Structure

- `/repo/resources`: Contains the application logo and other media resources.
- `/repo/mysql`: Includes the special MySQL connection files for MacBook users.
- `/repo/database`: SQL schema and migration files.
- `/repo/public`: Frontend resources like CSS, JS, and images.

## Contributing

Contributions are welcome! If you'd like to contribute to iGames, please fork the repository and create a pull request.

1. Fork the repo.
2. Create a branch for your feature.
3. Commit your changes.
4. Push to the branch.
5. Create a new Pull Request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

Made with 💻 by [Malindu Prabod](https://github.com/malinduwmp)
