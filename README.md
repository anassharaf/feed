# Coding Task – Data Feed

## Introduction
This is a command-line program built with Laravel Zero that processes an XML file and pushes the data to a database. The program is designed to be easily extendable and configurable, allowing different data storage options. It also includes error logging and testing capabilities.

## Getting Started
Follow the instructions below to set up and run the program.

### Prerequisites
- PHP 8.1 or higher
- Composer (https://getcomposer.org/)
- Docker (optional)

### Installation

#### Option 1: Using Composer (without Docker)
1. Clone the repository:
   ```shell
   git clone https://github.com/anassharaf/feed.git
2. Navigate to the project directory:
   ```shell
   cd feed
3. Install dependencies:
   ```shell
   composer install
#### Option 2: Using Docker (with Dockerfile)
1. Clone the repository:
   ```shell
   git clone https://github.com/anassharaf/feed.git
2. Navigate to the project directory:
   ```shell
   cd feed
3. Build the Docker image:
   ```shell
   docker build -t feed .

### Configuration
The program can be configured using the `.env` file.

Database Configuration
To configure the database connection, update the following environment variables in the `.env` file:

```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=feeding
DB_USERNAME=root
DB_PASSWORD=
```

>**Note**: If you choose to use MySQL instead of SQLite, update the `DB_CONNECTION` value to `mysql` and provide the appropriate MySQL database credentials.

### Usage
1. Run database migrations:
```
php feed migrate
```
2. Parse the XML file and push the data to the database:
```
php feed process:feed
```
>**Note**:  If you want to parse feed.xml file from another path, write the path after the command:
```
php feed process:feed <your_file_path>
```

### Testing
To run the tests, make sure you have set up the testing database configuration in the `.env` file. Then, run the migration for testing database:
```
php feed migrate --database=testing
```
Then, run the following command:
```
php feed test
```

### Contributing
Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.
