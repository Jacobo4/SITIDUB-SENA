const gulp = require('gulp');
const sass = require('gulp-sass');
// var autoprefixer = require('autoprefixer');
const browserSync = require('browser-sync').create();
var concat = require('gulp-concat');
// var clean = require('gulp-clean');
// var pug = require('gulp-pug');
// var sourcemaps = require('gulp-sourcemaps');
// var postcss = require('gulp-postcss');
// var $             = require('gulp-load-plugins')();

// var mq4HoverShim = require('mq4-hover-shim');
// var rimraf = require('rimraf').sync;


var paths = {
  public: './../site/www_mk/',
  dev: './dev/',
  sass: './dev/styles/',
  css: './dist/assets/css/',
  data: './dev/markup/_data/',
  node: './node_modules/'
};

// // Starts a BrowerSync instance
// gulp.task('browser-sync', function() {
//   browserSync.init({
//     server: {
//       baseDir: paths.public
//     }
//   });
// });

// Watch files for changes

function compile_scss() {
  //1. Where is my scss file
  return gulp.src(paths.sass + '*.scss')
    //2. pass what file through sass compiler
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
      //3. Where do i save the compiled css?
    .pipe(gulp.dest(paths.public + 'assets/css/'))
    .pipe(browserSync.stream());
    }

  function watch() {
    browserSync.init({
      server: {
        baseDir: paths.public
      }
    });

    gulp.watch(paths.sass + '**/*.scss', compile_scss); //callback para ejecutar compile_scss()
    gulp.watch(paths.public + '*.html').on('change', browserSync.reload);
    gulp.watch(paths.public + 'assets/js/**/*.js').on('change', browserSync.reload);
  }

  function compile_js() {
    return gulp.src([
        paths.node + 'jquery/dist/jquery.min.js',
        paths.node + 'bootstrap/dist/js/bootstrap.min.js'
      ])
      .pipe(concat('vendors.js'))
      .pipe(gulp.dest(paths.public + 'assets/js/'));
  };

  function setupBootstrap() {
    return gulp.src([
        paths.node + 'bootstrap/scss/**/*.scss',
      ])
      .pipe(gulp.dest(paths.sass + 'core/'));
  };

  function copy() {
    //Copy other external css assets
    gulp.src([paths.dev + 'assets/css/*.css']).pipe(gulp.dest(paths.public + 'assets/css/'));
    //Copy other external font assets
    gulp.src([paths.dev + 'assets/fonts/*']).pipe(gulp.dest(paths.public + 'assets/fonts/'));
    //Copy other external vendors
    gulp.src([paths.dev + 'assets/vendors/**/*']).pipe(gulp.dest(paths.public + 'assets/vendors/'));
    //Copy other external files
    gulp.src([paths.dev + 'assets/images/**/*']).pipe(gulp.dest(paths.public + 'assets/images/'));
    gulp.src([paths.dev + 'assets/files/**/*']).pipe(gulp.dest(paths.public + 'assets/files/'));
  };



  const asd = gulp.series(compile_js, watch);
  gulp.task(':)', asd)

  // gulp.task('build', gulp.parallel('copy','compile_js'));
  // gulp.task(':)', gulp.series('build', gulp.parallel('server', 'watch')));









  //
  // // Erases the dist folder
  // gulp.task('reset', function() {
  //     rimraf(paths.sass + 'core/**/*');
  //     rimraf(paths.public + 'assets/css/*');
  //     rimraf(paths.public + 'assets/fonts/*');
  // });
  //
  // // Erases the dist folder
  // gulp.task('clean', function() {
  //     rimraf('dist');
  // });
  //
  // // Copy Bootstrap filed into core development folder

  //

  //
  // //Theme Sass variables
  // var sassOptions = {
  //     errLogToConsole: true,
  //     outputStyle: 'compressed'
  // };
  //
  // // Compile bootstrap and Theme Sass

  //
  // /**
  //  * Compile .pug files and pass in data from json file
  //  */
  //
  // gulp.task('compile-pug', function () {
  //     gulp.src(paths.dev +'markup/pages/**/*.pug')
  //       .pipe(pug({
  //         pretty: true
  //       }))
  //       .pipe(gulp.dest(paths.public))
  //       .on('finish', browser.reload);
  // });
  //
  //
  // // Compile js from node modules

  //
  // //Copy Theme js to production site
  // gulp.task('copy-js', function() {
  //     gulp.src(paths.dev + 'assets/js/**/*.js')
  //         .pipe(gulp.dest(paths.public + 'assets/js/'));
  // });
  //
  // //Copy images to production site
  // gulp.task('copy-images', function() {
  //     gulp.src(paths.dev + 'assets/images/**/*')
  //         .pipe(gulp.dest(paths.public + 'assets/images/'));
  // });
  //
  // gulp.task('init', ['setupBootstrap']);
  // gulp.task('build', ['clean','copy','compile-js', 'copy-js', 'compile-sass', 'compile-pug', 'copy-images']);
