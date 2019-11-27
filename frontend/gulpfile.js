const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('autoprefixer');
const browserSync = require('browser-sync').create();
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const postcss = require('gulp-postcss');
const terser = require('gulp-terser');



var paths = {
  public: './../site/www_mk/',
  dev: './dev/',
  sass: './dev/styles/',
  css: './dist/assets/css/',
  node: './node_modules/',
  images:'./dev/assets/images/',
  fonts:'./dev/assets/fonts/'
};

var config = {
  sass: {
    outputStyle: 'compressed',
  },
  terser: {
    ecma: 6,
    keep_fnames: false,
    mangle: {
      toplevel: true,
    },
  },
  autoprefixer: {
    Browserslist: [
      "Chrome >= 45",
      "Firefox ESR",
      "Edge >= 12",
      "Explorer >= 10",
      "iOS >= 9",
      "Safari >= 9",
      "Android >= 4.4",
      "Opera >= 30"
    ]
  }
};

function compile_scss(done) {

  var processors = [
    autoprefixer(config.autoprefixer)
  ];
  return gulp.src(paths.sass + '*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(config.sass).on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(paths.public + 'assets/css/'))
    .pipe(browserSync.stream());
  done();
};


// Watch files for changes

function server() {
  browserSync.init({
    server: {
      baseDir: paths.public
    }
  });
};

function watch(done) {

  gulp.watch(paths.images + '*', copyAll).on('change', browserSync.reload);
  gulp.watch(paths.sass + '**/*.scss', compile_scss); //callback para ejecutar compile_scss()
  gulp.watch(paths.public + '*.html').on('change', browserSync.reload);
  gulp.watch(paths.dev + 'scripts/*.js', copy_js).on('change', browserSync.reload);
  done();
};

function compile_vendors_js(done) {
  return gulp.src([
      paths.node + 'jquery/dist/jquery.min.js',
      paths.node + 'bootstrap/dist/js/bootstrap.min.js',
      paths.node + 'wowjs/dist/wow.min.js'
    ])
    .pipe(concat('vendors.js'))
    .pipe(gulp.dest(paths.public + 'assets/js/'));
  done();
};



function copyAll(done) {
  //Copy other external css assets
  gulp.src([paths.dev + 'assets/css/*.css'])
  .pipe(concat('vendors.css'))
  .pipe(gulp.dest(paths.public + 'assets/css/'));
  //Copy other external font assets
  gulp.src([paths.dev + 'assets/fonts/*']).pipe(gulp.dest(paths.public + 'assets/fonts/'));
  //Copy other external vendors
  gulp.src([paths.dev + 'assets/vendors/**/*']).pipe(gulp.dest(paths.public + 'assets/vendors/'));
  //Copy other external files
  gulp.src([paths.dev + 'assets/images/**/*']).pipe(gulp.dest(paths.public + 'assets/images/'));
  //Copy local Json
  gulp.src([paths.dev + 'json/**/*']).pipe(gulp.dest(paths.public + 'assets/json/'));
  done();
};

function copy_js(done) {

  return gulp.src(paths.dev + 'scripts/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(concat('app.js'))
    .pipe(terser(config.terser))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(paths.public + 'assets/js/'))

  done();
};
// function setupBootstrap(done) {
//   return gulp.src([
//       paths.node + 'bootstrap/scss/**/*.scss',
//     ])
//     .pipe(gulp.dest(paths.sass + 'core/'));
//   done();
// };
// const setBootstrap = gulp.parallel(setupBootstrap);
// gulp.task('bootstrap',setBootstrap);

const build = gulp.parallel(copyAll, compile_vendors_js, copy_js)
const all = gulp.series(build, gulp.parallel(server, watch));
gulp.task(':)', all);
