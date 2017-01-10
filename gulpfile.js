"use strict";

var gulp        = require('gulp');
var sass        = require('gulp-sass');
var uglify      = require('gulp-uglifyjs');
var concat      = require('gulp-concat');
var rename      = require('gulp-rename');
var svgToSss    = require('gulp-svg-to-css');


var scssOptions = {
        errLogToConsole: true,
        outputStyle: 'compressed'
    };

gulp.task('scssMain', function () {

    return gulp.src('library/scss/main.scss')
        .pipe(sass(scssOptions))
        .pipe(gulp.dest('library/scss/'));
});

gulp.task('scssTemplates', function () {
    
    gulp.src('library/scss/templates/*.scss')
        .pipe(sass(scssOptions))
        .pipe(gulp.dest('library/css/templates/'));
});

gulp.task('svg-to-css', function() {
    
    return gulp.src('library/svg/**/*.svg')
        .pipe(svgToSss('svg.css'))
        .pipe(gulp.dest('library/svg/'));
})

gulp.task('jsMain', function() {
    
    return gulp.src('library/js/gloabal.js')
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('library/js/min/'));
});

gulp.task('jsTemplates', function() {
    
    return gulp.src('library/js/templates/*.js')
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('library/js/min/templates/'));
});

// Watch task
gulp.task('default', ['scssMain', 'scssTemplates', 'jsMain', 'jsTemplates', 'svg-to-css'], function() {
    
    gulp.watch('library/scss/**/*.scss', ['scssMain', 'scssTemplates']);
    gulp.watch('library/js/**/*.js', ['jsMain', 'jsTemplates']);
    gulp.watch('library/svg/**/*.svg', ['svg-to-css']);
});