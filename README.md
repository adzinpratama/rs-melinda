# My App Test

## Form Manajemen Jadwal

![IMG_8566.jpg](https://github.com/adzinpratama/rs-melinda/blob/main/screenshot/FormManajemenJdwal.png?raw=true)

## Tampil Jadwal

![IMG_8566.jpg](https://github.com/adzinpratama/rs-melinda/blob/main/screenshot/listJadwal.png?raw=true)

## Form Manajemen Dokter

![IMG_8566.jpg](https://github.com/adzinpratama/rs-melinda/blob/main/screenshot/Form%20Manajemen%20Dokter.png?raw=true)

## Tampil Dokter

![IMG_8566.jpg](https://github.com/adzinpratama/rs-melinda/blob/main/screenshot/ListDokter.png?raw=true)

## Soal 2

![IMG_8566.jpg](https://github.com/adzinpratama/rs-melinda/blob/main/screenshot/soal2.png?raw=true)

## Instalasi

Clone from Github

```
git clone https://github.com/adzinpratama/rs-melinda.git
```

Masuk Ke direktori warehouse

```
cd rs-melinda
```

-   copy .env.example ke .env
-   Sesuaikan database pada lingkungan
    development

```
cp .env.example .env
```

```
composer install
```

```
php artisan key:generate
```

install package node

```
npm install
```

start mix

```
npm run dev
```

Migrasi Database

```
php artisan migrate --seed
```

jalankan server

```
php artisan serve
```
