/**
 * Gulp Main Config Setup.
 * Reference: https://github.com/gulpjs/gulp#sample-gulpfilejs
 * Github: https://github.com/gulpjs/gulp
 * 
 * Requirement(s):
 *  - Node.js from v8 up to latest.
 *  - npm from v5 up to latest.
 * 
 * Babel Setup for Browserlist.
 * Reference:
 *  - https://github.com/browserslist/browserslist
 *  - https://babeljs.io/docs/en/babel-preset-env#browserslist-integration
 * 
 * Browser List Compatibiltiy Setup Reference:
 *  - https://stackoverflow.com/a/43076327
 * 
 * To avoid some issue on variable reference we used IIFE strategy.
 * 
 * @author GMA New Media Inc.<joshua.reyes@gmanmi.com>
 */
var fs = require('fs');
var del =  require('del');
var gulp = require('gulp');
var sass = require('gulp-sass');
var gzip = require('gulp-gzip');
var babel = require('gulp-babel');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css');
var autoPrefixer = require('gulp-autoprefixer');

/**
 * Read scripts configuration file.
 */
var scriptsConfig = JSON.parse(fs.readFileSync('scripts.json', 'utf8'));

/**
 * Read styles configuration file.
 */
var stylesConfig = JSON.parse(fs.readFileSync('styles.json', 'utf8'));

/**
 * Prepare hardcoded path setup for tasks.
 */
var paths = {
  scripts: {
    src: 'src/js/**/*.*',
    dest: {
      pages: '../public/assets/dist/js/pages/',
      components: '../public/assets/dist/js/components/'
    }
  },
  styles: {
    src: 'src/scss/**/*.*',
    dest: {
      pages: '../public/assets/dist/css/pages/',
      components: '../public/assets/dist/css/components/'
    }
  }
};

/**
 * Command for the scripts processing.
 */
function buildScripts() {

  var pages = scriptsConfig.pages;
  var components = scriptsConfig.components;
  var pageTasksCollection = [];
  var componentTasksCollection = [];

  // For Pages.
  for (var page in pages) {

    (function (item) {
      gulp.task(item + '_script_page_task', function () {
        return gulp.src(pages[item], { sourcemaps: true })
          .pipe(babel())
          .pipe(uglify())
          .pipe(concat(item + '.js'))
          .pipe(rename({ suffix: '.min' }))
          .pipe(gulp.dest(paths.scripts.dest.pages));
      });
    })(page);

    // For GZIP version.
    (function (item) {
      gulp.task(item + '_script_gz_page_task', function () {
        return gulp.src(pages[item], { sourcemaps: true })
          .pipe(babel())
          .pipe(uglify())
          .pipe(concat(item + '.gz'))
          .pipe(gzip({ append: false }))
          .pipe(gulp.dest(paths.scripts.dest.pages));
      });
    })(page);

    pageTasksCollection.push(page + '_script_page_task');
    pageTasksCollection.push(page + '_script_gz_page_task');
  }

  // For Components.
  for (var component in components) {

    (function (item) {
      gulp.task(item + '_script_component_task', function() {
        return gulp.src(components[item], { sourcemaps: true })
          .pipe(babel())
          .pipe(uglify())
          .pipe(concat(item + '.js'))
          .pipe(rename({ suffix: '.min' }))
          .pipe(gulp.dest(paths.scripts.dest.components));
      });
    })(component);
    
    // For GZIP version.
    (function (item) {
      gulp.task(item + '_script_gz_component_task', function () {
        return gulp.src(components[item], { sourcemaps: true })
          .pipe(babel())
          .pipe(uglify())
          .pipe(concat(item + '.gz'))
          .pipe(gzip({ append: false }))
          .pipe(gulp.dest(paths.scripts.dest.components));
      });
    })(component);

    componentTasksCollection.push(component + '_script_component_task');
    componentTasksCollection.push(component + '_script_gz_component_task');
  }

  gulp.task('build_scripts', 
    gulp.series(
      pageTasksCollection.concat(componentTasksCollection)
    )
  );
}

/**
 * Command for the styles processing.
 */
function buildStyles() {

  var pages = stylesConfig.pages;
  var components = stylesConfig.components;
  var pageTasksCollection = [];
  var componentTasksCollection = [];

  // For Pages.
  for (var page in pages) {
    
    (function (item) {
      gulp.task(item + '_style_page_task', function () {
        return gulp.src(pages[item], { sourcemaps: true })
          .pipe(sass())
          .pipe(cleanCSS({level: {1: {specialComments: 0}}}))
          .pipe(autoPrefixer())
          .pipe(concat(item + '.css'))
          .pipe(rename({ suffix: '.min' }))
          .pipe(gulp.dest(paths.styles.dest.pages));
      });
    })(page);

    pageTasksCollection.push(page + '_style_page_task');
  }

  // For Components.
  for (var component in components) {

    (function (item) {
      gulp.task(item + '_style_component_task', function () {
        return gulp.src(components[item], { sourcemaps: true })
        .pipe(sass())
        .pipe(cleanCSS({level: {1: {specialComments: 0}}}))
        .pipe(autoPrefixer())
        .pipe(concat(item + '.css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(paths.styles.dest.components));
      });
    })(component);

    componentTasksCollection.push(component + '_style_component_task');
  }

  gulp.task('build_styles',
    gulp.series(
      pageTasksCollection.concat(componentTasksCollection)
    )
  );
}

/**
 * Command for the clean dist directory.
 */
function clean() {
  return del(['dist']);
}

/**
 * Register gulp task commands.
 */
buildScripts();
buildStyles();

exports.clean = clean;
exports.assets = gulp.series('build_scripts', 'build_styles');

/**
 * Thanks for the Gulp Watch Hook, an easy life :-)
 * Every changes for scripts and styles will automatically fire
 * the build process for scripts and styles.
 */
exports.watch = function () {
  gulp.watch(paths.scripts.src, gulp.series('build_scripts'));
  gulp.watch(paths.styles.src, gulp.series('build_styles'));
};
