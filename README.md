<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Important
* Bu proje `Laravel 9` ve `php 8.0.2` ile yazılmıştır. Laravell Passport ve bazı gereksinimler için php versiyonu zorunludur.

## Install Project

* Terminal'i açın ve proje ana klasörüne erişin.
```
composer update
```
```
npm install
```
* Proje ana klasöründe bulunan **.env.example** dosyasını kopyalayıp **.env** olarak farklı kaydedin ya da direkt ismini değiştirin.

* **.env** dosyası içinde veri tabanı bağlantısı ayarınızı yapın ve **APP_URL** adresini düzenleyin.

* `\vendor\laravel\framework\src\Illuminate\Auth\EloquentUserProvider.php` içerisindeki **validateCredentials** fonksiyonunu aşağıdaki kod ile değiştir.
```php
    public function validateCredentials(UserContract $user, array $credentials)
    {
        if (is_null($plain = $credentials['password'])) {
            return false;
        }
        return md5($plain) == $user->getAuthPassword();

        //return $this->hasher->check($plain, $user->getAuthPassword());
    }
```
```
php artisan key:generate
```
```
php artisan migrate
```
```
php artisan passport:install
```

```
npm run dev
```
