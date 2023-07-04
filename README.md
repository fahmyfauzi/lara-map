<div id="top"></div>

# Laramap

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about">About The Project</a>
         <ul>
        <li><a href="#features">Features</a></li>
      </ul>
    </li>
    <li>
      <a href="#installation">Installation</a>
    </li> 
    <li>
      <a href="#screenshoot">Screenshoot</a>
    </li>
  </ol>
</details>

<p id="about">
This system is built with the laravel 9 framework , laravel livewire and using MapBox.
</p>

<h4 id="features">
    The features of this system globally include:
</h4>
<ul>
    <li>
       Simple without reload.
    </li>
    
</ul>

## Installation

To run the application on your computer, please follow the following command :

1. Clone the repo
    ```sh
    git clone https://github.com/fahmyfauzi/lara-map.git
    ```
2. Change directory in project which already clone
    ```sh
    cd lara-map
    ```
3. Install Composer packages
    ```sh
    composer install
    ```
4. Create database on your computer
5. Create a copy of your .env file
    ```sh
    cp .env.example .env
    ```
7. Generate an app encryption key

    ```sh
    php artisan key:generate
    ```
6. In the .env file, add database information to allow Laravel to connect to the database
    ```sh
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=DB_NAME
    DB_USERNAME=DB_USERNAME
    DB_PASSWORD=DB_PASSWORD
    ```

8. Change mapbox key on .env
    ```sh
       MAPBOX_KEY=YOUR_KEY_MAPBOX
    ```
9. Migrate database
    ```sh
    php artisan migrate
    ```
10. Running project

    ```sh
    php artisan serve
    npm run dev
    ```

    <p align="right">(<a href="#top">back to top</a>)</p>

<div id="screenshoot"></div>

## Screenshoot
1. users
![111](https://github.com/fahmyfauzi/lara-map/assets/58255031/44cd8f10-8039-4648-ba90-a00a7e6927c4)

2. admin
![222](https://github.com/fahmyfauzi/lara-map/assets/58255031/185438fb-2a38-4593-8a15-192ad106a60a)

