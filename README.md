# Laravel-Vue-API-File-Upload

Repository for the article:

There are two pages: 

- One example is for uploading avatar during User registration (with Laravel default)
- Another example is uploading thumbnail for new article (with Spatie Medialibrary)


![Laravel File Upload Vue.js screenshot](https://quickadminpanel.com/blog/wp-content/uploads/2020/04/Screen-Shot-2020-04-26-at-11.17.36-AM.png)

- - - - -

API for the Article example was generated with our QuickAdminPanel generator: [QuickAdminPanel.com](https://quickadminpanel.com)
Read more: [New API Generator 2019 – now with Laravel Passport!](https://quickadminpanel.com/blog/new-api-generator-2019-now-with-laravel-passport/)

- - - - -

## How to use

### Back-end Code: Laravel

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- Add your domain name into __.env__ file's __APP_URL__ variable


### Front-end Code: Vue.js

- After cloning the repository, add URL of the back-end into __src/main.js__ file
- Run `npm install`
- Run `npm run serve` and enter the URL shown in the Terminal.


- - - - -


## License

Basically, feel free to use and re-use any way you want.

---

## More from our LaravelDaily Team

- Check out our adminpanel generator [QuickAdminPanel](https://quickadminpanel.com)
- Subscribe to our [YouTube channel Laravel Business](https://www.youtube.com/channel/UCTuplgOBi6tJIlesIboymGA)
- Enroll in our [Laravel Online Courses](https://laraveldaily.teachable.com/)
