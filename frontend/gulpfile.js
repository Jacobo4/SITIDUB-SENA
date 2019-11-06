const gulp = require('gulp');
const sass = require('gulp-sass');
var autoprefixer = require('autoprefixer');
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


// Watch files for changes

function compile_scss(done) {
  //1. Where is my scss file
  return gulp.src(paths.sass + '*.scss')

    //2. pass what file through sass compiler
    .pipe(sass({
      // outputStyle: 'compressed'
    }).on('error', sass.logError))
    .pipe(autoprefixer({
      cascade: true
    }))

    //3. Where do i save the compiled css?
    .pipe(gulp.dest(paths.public + 'assets/css/'))
    .pipe(browserSync.stream());
  done();
}

function watch(done) {
  browserSync.init({
    server: {
      baseDir: paths.public
    }
  });

  gulp.watch(paths.sass + '**/*.scss', compile_scss); //callback para ejecutar compile_scss()
  gulp.watch(paths.public + '*.html').on('change', browserSync.reload);
  gulp.watch(paths.public + 'assets/js/**/*.js').on('change', browserSync.reload);
  done();
}

function compile_js(done) {
  return gulp.src([
      paths.node + 'jquery/dist/jquery.min.js',
      paths.node + 'bootstrap/dist/js/bootstrap.min.js'
    ])
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest(paths.public + 'assets/js/'));
  done();
};

function setupBootstrap(done) {
  return gulp.src([
      paths.node + 'bootstrap/scss/**/*.scss',
    ])
    .pipe(gulp.dest(paths.sass + 'core/'));
  done();
};

function copyAll(done) {
  //Copy other external css assets
  gulp.src([paths.dev + 'assets/css/*.css']).pipe(gulp.dest(paths.public + 'assets/css/'));
  //Copy other external font assets
  gulp.src([paths.dev + 'assets/fonts/*']).pipe(gulp.dest(paths.public + 'assets/fonts/'));
  //Copy other external vendors
  gulp.src([paths.dev + 'assets/vendors/**/*']).pipe(gulp.dest(paths.public + 'assets/vendors/'));
  //Copy other external files
  gulp.src([paths.dev + 'assets/images/**/*']).pipe(gulp.dest(paths.public + 'assets/images/'));
  gulp.src([paths.dev + 'assets/files/**/*']).pipe(gulp.dest(paths.public + 'assets/files/'));

  done();
};


const build = gulp.parallel(copyAll, compile_js)
const all = gulp.series(build, watch);
gulp.task(':)', all)
