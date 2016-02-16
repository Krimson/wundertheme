//    ______   __    __  __        _______
//   /      \ /  |  /  |/  |      /       \
//  /$$$$$$  |$$ |  $$ |$$ |      $$$$$$$  |
//  $$ | _$$/ $$ |  $$ |$$ |      $$ |__$$ |
//  $$ |/    |$$ |  $$ |$$ |      $$    $$/
//  $$ |$$$$ |$$ |  $$ |$$ |      $$$$$$$/
//  $$ \__$$ |$$ \__$$ |$$ |_____ $$ |
//  $$    $$/ $$    $$/ $$       |$$ |
//   $$$$$$/   $$$$$$/  $$$$$$$$/ $$/
//

// Gulp and some tools
var gulp = require('gulp-help')(require('gulp'));
var gutil = require("gulp-util");
var notifier = require('terminal-notifier');
var chalk = require("chalk");
var browserSync = require('browser-sync').create();
var gulpSequence = require('gulp-sequence');

// Sass
var sass = require("gulp-sass");
var sassGlob = require('gulp-sass-glob');
var jsonImporter = require('node-sass-json-importer');
var prefix = require("gulp-autoprefixer");
var sourcemaps = require("gulp-sourcemaps");

// Css
var cssnano = require('gulp-cssnano');

// Load configuration file
var config = require("./config.json");

// Error Callback
var errorCallBack = function (error, metadata) {
    if (error) {
        // throw error;
        console.log(error);
    }

    console.log(metadata, 'Metadata produced during the build process');
};

// -----------------------------------------------------------------------------
// SASS -- https://www.npmjs.com/package/gulp-sass
// SASS GLOBBING -- https://www.npmjs.com/package/gulp-sass-glob
// -----------------------------------------------------------------------------

gulp.task("sass", "Compiles your SCSS files to CSS", function () {
    return gulp.src(config.path.scss + "/*.scss")
        .pipe(sourcemaps.init())
        .pipe(sassGlob())
        .pipe(sass({
            includePaths: [
                require("node-bourbon").includePaths,
                require("node-neat").includePaths[1],
                require("node-normalize-scss").includePaths,
                config.path.bower + config.path.fontAwesome
            ],
            importer: jsonImporter,
            outputStyle: config.sass.style,
        }))
        .on("error", function (err) {
            gutil.log(gutil.colors.black.bgRed("SASS ERROR", gutil.colors.red.bgBlack(" " + (err.message.split("  ")[2]))));
            gutil.log(gutil.colors.black.bgRed("FILE:", gutil.colors.red.bgBlack(" " + (err.message.split("\n")[0]))));
            gutil.log(gutil.colors.black.bgRed("LINE:", gutil.colors.red.bgBlack(" " + err.line)));
            gutil.log(gutil.colors.black.bgRed("COLUMN:", gutil.colors.red.bgBlack(" " + err.column)));
            notifier(err.message.split("\n")[0], { title: "LINE " + err.line });
            return this.emit("end");
        })
        .pipe(prefix(config.autoprefixer))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(config.path.css))
        .pipe(browserSync.stream());
});

// -----------------------------------------------------------------------------
// CSS MINIFY -- https://www.npmjs.com/package/gulp-minify-css
// -----------------------------------------------------------------------------

gulp.task("css-minify", "Minifies css files for production enviroments",  function() {
    gulp.src(config.path.css + "/*.css")
        .pipe(cssnano())
        .pipe(gulp.dest(config.path.css));
});

// -----------------------------------------------------------------------------
// BROWSERSYNC -- http://www.browsersync.io/docs/gulp/
// -----------------------------------------------------------------------------

gulp.task("browser-sync", "Set up a server with BrowserSync and test across devices", function() {
    browserSync.init({
        proxy: config.browsersync.proxy,
        notify: false
    });
});

// -----------------------------------------------------------------------------
// WATCH
// -----------------------------------------------------------------------------

gulp.task("watch", "Watches your SASS files", function() {
    gulp.watch(config.path.scss + "/**/*.scss", ["sass"]);
});

// -----------------------------------------------------------------------------
// DEFAULT TASK
// -----------------------------------------------------------------------------

gulp.task("default", gulpSequence(
    "sass",
    //"css-minify",
    "watch",
    "browser-sync"
    )
);
