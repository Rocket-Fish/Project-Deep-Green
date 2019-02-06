# Project Deep Green Ocean
## A portfolio website for Jimmy.
I portfolio which could not only be easily updated and maintained, but also user friendly and reactive.
Instead of creating plugins or modifing an existing CMS (such as wordpress),
I decided to set out and build my own CMS with a reactive front end Single Page Application (*SPA*), and a dynamic backend based using relational databases, and a RESTful API.

## Build
### Major Highlights
This project was built on top of many other projects, here are a few highlights:
* [Laravel](https://github.com/laravel/laravel) - Backend PHP Framework for RESTful API
* [Vue.js](https://github.com/vuejs/vue) - Front End  SPA
* [Three.js](https://github.com/mrdoob/three.js) - 3D Animations for specific components
* [websanova/vue-auth](https://github.com/websanova/vue-auth) - Front end AUTH for edit control

Full list of dependancies can be viewed in [package.json](https://github.com/Rocket-Fish/Project-Deep-Green/blob/master/package.json)

## Branches
### Main Branches
[dev](https://github.com/Rocket-Fish/Project-Deep-Green/tree/dev) for the latest iteration of the project using the most cutting edge techniques.

[release/r](https://github.com/Rocket-Fish/Project-Deep-Green/tree/release/r) the current version live on the [server](https://deepgreenocean.com)

### Other Branches
All other Branches (such as [master](https://github.com/Rocket-Fish/Project-Deep-Green/tree/master)) are no longer under active development, and only serve as a legacy
of a previous iteration of the project.

## Forking this project
This project was built on the following environment versions.
```
$ npm -v
6.4.1

$ composer --version
Composer version 1.8.0 2018-12-03 10:31:16

$ php -v
PHP 7.3.0 (cli) (built: Dec  6 2018 02:17:00) ( ZTS MSVC15 (Visual C++ 2017) x86 )
```

After Forking and cloning this project, make sure to rename `.env.example` to `.env` and add your own environment information into the file.

If you do not already have an `APP_KEY`, make sure to generate one using `php artisan key:generate`


You can then run the following in succession to have a working copy:
```
 $ npm install

 $ npm run dev

 $ php artisan serve
```


## Licence:
[MIT](https://opensource.org/licenses/MIT)
