var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var shell = require('gulp-shell');
var sourcemaps = require('gulp-sourcemaps');
var prefixer = require("gulp-autoprefixer");
var uglify = require('gulp-uglify');
var browserSync = require('browser-sync').create();

/**
 * Task when css or js files are changed
 */
gulp.task('cssjs:reload', ['sass', 'compress'], function () {
    // Nothing here yet
});

/**
 * Browsersync
 */
gulp.task("browser-sync", function () {
    browserSync.init({
        proxy: "http://192.168.50.2/",
        notify: false
    });
});

/**
 * This task generates CSS from all SCSS files and compresses them down.
 */
gulp.task('sass', function () {
    return gulp.src('./scss/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: [
                require("node-bourbon").includePaths,
                require("node-neat").includePaths[1],
            ],
            noCache: true,
            outputStyle: "compressed",
            lineNumbers: false,
            loadPath: './css/*',
            sourceMap: true
        }))
        .on("error", function (err) {
            gutil.log(gutil.colors.black.bgRed("SASS ERROR", gutil.colors.red.bgBlack(" " + (err.message.split("  ")[2]))));
            gutil.log(gutil.colors.black.bgRed("FILE:", gutil.colors.red.bgBlack(" " + (err.message.split("\n")[0]))));
            gutil.log(gutil.colors.black.bgRed("LINE:", gutil.colors.red.bgBlack(" " + err.line)));
            gutil.log(gutil.colors.black.bgRed("COLUMN:", gutil.colors.red.bgBlack(" " + err.column)));
            return this.emit("end");
        })
        .pipe(prefixer({
            browsers: ['last 3 version', '> 2%'],
        }))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream());
});

/**
 * This task minifies javascript in the js/js-src folder and places them in the js directory.
 */
gulp.task('compress', function () {
    return gulp.src('./js/js-src/*.js')
        .pipe(sourcemaps.init())
        .pipe(uglify())
        .on("error", function (err) {
            gutil.log(gutil.colors.black.bgRed("JS ERROR", gutil.colors.red.bgBlack(" " + (err.message))));
            return this.emit("end");
        })
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./js'));
});

/**
 * Defines the watcher task.
 */
gulp.task('watch', function () {
    // watch scss and js
    gulp.watch(['scss/**/*.scss', 'js/js-src/**/*.js'], ['cssjs:reload']);
});

gulp.task('dev', ['watch', 'compress', 'browser-sync']);

gulp.task('default', ['sass', 'compress']);
