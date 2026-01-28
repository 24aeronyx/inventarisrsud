# RSUD Laravel Project

## Instalasi & Setup

1. **Clone Repository**

    ```sh
    git clone https://github.com/ifnuu01/RSUD.git
    cd RSUD
    ```

2. **Install Dependency**

    ```sh
    composer install
    npm install
    ```

3. **Copy File Environment**

    ```sh
    cp .env.example .env
    ```

4. **Generate Application Key**

    ```sh
    php artisan key:generate
    ```

5. **Konfigurasi Database**

    - Edit file `.env` sesuai konfigurasi database Anda.

6. **Jalankan Migrasi & Seeder**

    ```sh
    php artisan migrate --seed
    ```

7. **Build Frontend**

    ```sh
    npm run build
    ```

8. **Jalankan Server**
    ```sh
    php artisan serve
    ```

## Akun Default

Setelah seeding, akun default:

-   **Username:** admin
-   **Password:** admin

## Dokumentasi Laravel

Untuk dokumentasi lebih lanjut, kunjungi [Laravel Documentation](https://laravel.com/docs).
