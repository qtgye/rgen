var fs           = require('fs'),
    assets       = JSON.parse(fs.readFileSync('./assets.json', 'utf8')),
    gulp         = require('gulp'),
    rename       = require('gulp-rename'),
    jshint       = require('gulp-jshint'),
    stylish      = require('jshint-stylish'),
    concat       = require('gulp-concat'),
    sass         = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer');


var admin = false;

assets = admin ? assets.admin : assets.front; 

var scriptFiles = assets.script.source.map(function ( filename ) {
        return assets.script.sourceDir + filename + '.js';
    });


/**
 * Styles task
 */

gulp.task('styles',function() {
    return sass(assets.sass.source, { 'style' : 'expanded' })
    .on('error', sass.logError)
    .pipe(autoprefixer( { browsers : [ '> 1%', 'IE 11'] } ))
    .pipe(rename('_build.css'))
    .pipe(gulp.dest(assets.sass.destination));
});

/**
 * Lint task
 */

gulp.task('lint', function() {
  return gulp.src(scriptFiles)
    .pipe(jshint({     
        asi : true
    }))
    .pipe(jshint.reporter(stylish));
});

/**
 * Scripts task
 */

gulp.task('scripts', [ 'lint' ], function() {
    return gulp.src(scriptFiles)
    .pipe(concat('_build.js' , { newLine : '\r\n' }))
    .on('error',function (err) {
        console.warn(err);
    })
    .pipe(gulp.dest(assets.script.destination));
});

/**
 * Watch tasks
 */

gulp.task('watch', [ 'styles', 'scripts' ], function() {
   gulp.watch(assets.sass.sourceDir+'**/*.scss', ['styles']);
   gulp.watch(assets.script.sourceDir+'**/*.js', ['scripts']); 
});

gulp.task('default', [ 'styles', 'scripts' ], function() {

});