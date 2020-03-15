var gulp = require('gulp');
var plugins = require('gulp-load-plugins')();

// --

var onError = function(err) {
	console.log(err.message);
	this.emit('end');
}

gulp.task('styles', function() {
	return gulp.src('./scss/main.scss')
		.pipe(plugins.plumber({
			errorHandler: onError
		}))
		.pipe(plugins.sass())
		.pipe(plugins.autoprefixer({ browsers: ['last 2 versions'] }))
		.pipe(plugins.cleanCss())
		.pipe(plugins.rename('main.min.css'))
		.pipe(gulp.dest('./css'))
		.pipe(plugins.livereload());
});

gulp.task('watch', ['styles'], function() {
	plugins.livereload.listen();
	plugins.watch(['./scss/**/*.scss'], function () {
		return gulp.start('styles');
	});
});

gulp.task('default', ['styles']);