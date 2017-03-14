// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');

// Compile Our Sass
gulp.task('sass', function () {
    return gulp.src('assets/sass/style.scss')
        .pipe(sass())
        .pipe(gulp.dest('assets/css'))
});

// Watch Files For Changes
gulp.task('watch', function () {
    gulp.watch(['assets/sass/**/*'], ['sass']);
});

// Default Task
gulp.task('default', ['sass', 'watch']);