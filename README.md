# GIS and Virtual Tour
Sebuah proyek sederhana yang dikembangkan dari tutorial YouTube: @TahuCoding

## features
- Map
- Virtual Tour
- Dashboard Manage Map


## requirements
- php 8.0.2
- database mysql
- laravel 10.0
- laragon
- chrome
- composer
- [MapBox](mapbox.com)
- [Panoee](panoee.com)

## installation
1. Clone repositori
    ```sh
    git https://github.com/fahmyfauzi/lara-map.git
    ```
2. masuk ke dalam directori
    ```sh
    cd lara-map
    ```
3. Instal composer
    ```sh
    composer install
    or
    composer update
    ```
4. Copy file .env.example 
    ```
    cp .env.example .env
    ```
4. Generate an app encryption key

    ```sh
    php artisan key:generate
    ```
5. Create database on your computer or phpMyAdmin
6. In the .env file, add database information to allow Laravel to connect to the database
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel_didamelid
    DB_USERNAME=DB_USERNAME
    DB_PASSWORD=DB_PASSWORD
    ```
    
6. Change mapbox key on .env
    ```
    MAPBOX_KEY=YOUR_KEY_MAPBOX
    ```

7. migrasi database
    ```
    php artisan migrate 
    ```
8. install package
    ```
    npm install
    npm run build
    ```
    
9. jalankan project
    ```sh
   php artisan serve
    ```


## usage
- buka chrome masukan url ```lara-map.test``` atau ``` http://127.0.0.1:8000/ ```
- akses ```lara-map.test/login``` atau ``` lara-map.test/register ``` untuk register
- login dan coba fitur-fiturnya

## credits

[Fahmy Fauzi ](https://github.com/fahmyfauzi)

## screanshot
- Halaman Utama
  ![Uploading Screenshot (247).png…]()

- Halaman Readmore atau Virtual Tour
  ![eb1ea3bd-eec7-44b2-92e3-125bafb45a6d](https://github.com/fahmyfauzi/lara-map/assets/58255031/64849bdc-c8a6-4144-8737-21cdd100b124)

- Halaman Admin Dashboard
  ![Screenshot (248)](https://github.com/fahmyfauzi/lara-map/assets/58255031/323cf73d-43c3-40a0-a054-c3ec93fff894)
