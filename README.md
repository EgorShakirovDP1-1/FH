# Film Hunter (Beta)


  

### Used Technologies

  

- Vue 3

- Bootstrap 5 (Bootswatch)

- Laravel 10

- Inertia

- GitHub

  

### Test cases

  

- Test cases are in testcase.docx file

  

## Setup Instructions

  

### Prerequisites

  

Before getting started, make sure you have the following installed on your system:

  

- [PHP](https://www.php.net/) (>= 8.0)

- [Composer](https://getcomposer.org/)

- [Node.js](https://nodejs.org/) (>= 18.x)

- [NPM](https://www.npmjs.com/) (usually comes with Node.js)

  

### Steps to Setup

  

1.  **Clone the repository:**

  

```bash



```

  

2.  **Navigate to the project directory:**

  

```bash



```

  

3.  **Install PHP dependencies:**

  

```bash

composer install

```

  

4.  **Install Node.js dependencies:**

  

```bash

npm install

```

  

5.  **Create a copy of the .env.example file and rename it to .env:**

  

```bash

cp .env.example .env

```

  

6.  **Generate an application key:**

  

```bash

php artisan key:generate

```

  

7.  **Run database migrations and seed (if needed):**

  

```bash

php artisan migrate:fresh && php  artisan  db:seed  --class=MainSeeder

```

  

8.  **Generate a symbolic link from "public/storage" to "storage/app/public":**

  

```bash

php artisan storage:link

```

  



  



  



  

10.  **Start the development server:**

  

```bash

php artisan serve

```

  



  

```bash

npm run dev

```

  

Your application will be available at `http://localhost:8000`.

  

12.  **Visit the application in your browser:**

  

Open your web browser and navigate to `http://localhost:8000`.

  

That's it! You should now have the project set up and running locally on your machine.
