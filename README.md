# Konnect

Konnect is an NLP-based social media website that leverages natural language processing techniques to enhance user interaction and experience. This repository contains the code for the Konnect platform, including the front-end, back-end, and database connections.

## Features

- **User Authentication**: Register, login, and manage user sessions.
- **Social Feed**: View and interact with posts from other users.
- **Profile Management**: Create and customize user profiles.
- **NLP Integration**: Utilize NLP for content recommendations and sentiment analysis.

## Technologies Used

- **PHP**: Server-side scripting.
- **CSS**: Styling and layout.
- **JavaScript**: Client-side scripting.
- **MySQL**: Database management.

## Getting Started

### Prerequisites

- PHP >= 7.4
- MySQL
- Web Server (e.g., Apache, Nginx)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Vishal-Pattar/Konnect.git
   ```
2. Navigate to the project directory:
   ```bash
   cd Konnect
   ```
3. Set up the database:
   - Create a MySQL database.
   - Import the database schema from `dbconnect.php`.

4. Configure the database connection in `dbconnect.php`:
   ```php
   $servername = "your_server_name";
   $username = "your_username";
   $password = "your_password";
   $dbname = "your_database_name";
   ```

5. Start your web server and navigate to the project directory in your browser.

### Folder Structure

- **CSS/**: Contains stylesheets.
- **JS/**: Contains JavaScript files.
- **Images/**: Contains image assets.
- **Upload/**: Contains uploaded files.
- **index.php**: Main entry point of the application.
- **dbconnect.php**: Database connection script.
- **register.php**: User registration script.
- **login.php**: User login script.
- **logout.php**: User logout script.
- **explore.php**: Script to explore posts.
- **newworkfeed.php**: Script for the new work feed.
- **newworkprof.php**: Script for the new work profile.

## License

This project is licensed under the GPL-3.0 License - see the [LICENSE](LICENSE) file for details.

## Contributing

1. Fork the repository.
2. Create your feature branch:
   ```bash
   git checkout -b feature/YourFeature
   ```
3. Commit your changes:
   ```bash
   git commit -m 'Add some feature'
   ```
4. Push to the branch:
   ```bash
   git push origin feature/YourFeature
   ```
5. Open a pull request.

## Contact

For any questions or issues, please open an issue on GitHub.
