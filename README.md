<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## About This Source

This source code is for the coding skill test at Coding Collective Backend Laravel, Home Task Simple Payment Gateway Integrations. It has a GUI feature for the Deposit & Withdraw processes using Livewire. It is prepared to be run in a Docker container platform.

## How to Setup?

-   Clone this repo to your machine
-   Setup .env.production file duplicate from .env.example
-   If you want to rebuild this image, run `docker build -f Docker/laravel.Dockerfile -t your-image-name .` and then update the "image" property in the docker-compose.yml file with the name of the image you have built.
-   Run `docker-compose -f docker-compose.yml up -d` to setup a container
-   If the container is running successfully, you can access the app on the host using port 8080 (or the port you specified in the docker-compose.yml file). Simply open your web browser and enter the following URL: http://localhost:8080
-   The file `Docker/entrypoint/artisan.sh` is the entrypoint script that can be customized when the container is run. For example, you can use it to run database migrations or seeders.

That all! A brief explanation of this repository. If you encounter any issues or have any concerns, please feel free to contact me. Thank you!
