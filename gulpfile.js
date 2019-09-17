var gulp        = require('gulp');
var sass        = require('gulp-sass');
var cleanCSS    = require('gulp-clean-css');
var sourcemaps  = require('gulp-sourcemaps');
var rename      = require('gulp-rename');
var uglify      = require('gulp-uglify');
var exec        = require('child_process').exec;
var del         = require('del');

// Create sourcemaps and minify the styles
gulp.task('styles', function() {
  return gulp.src('src/public_html/styles/scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(cleanCSS())
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('build/public_html/styles'));
  }
);

// Minify Javascript
gulp.task('scripts', function() {
  return gulp.src('src/public_html/scripts/js/**/*.js')
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest('build/public_html/scripts'));
  }
);

// Copy images
gulp.task('images', function() {
  return gulp.src(['src/public_html/images/**/*', '!src/public_html/images/**/*.md'])
    .pipe(gulp.dest('build/public_html/images'));
  }
);

// Copy PHP from src to build
gulp.task('php', function() {
  return gulp.src('src/**/*.php')
    .pipe(gulp.dest('build'));
  }
);

// Copy HTML from src to build
gulp.task('html', function() {
  return gulp.src('src/**/*.html')
    .pipe(gulp.dest('build'));
  }
);

// Copy XML from src to build
gulp.task('xml', function() {
  return gulp.src('src/**/*.xml')
    .pipe(gulp.dest('build'));
  }
);

// Copy style vendor files to build
gulp.task('style-vendor', function() {
  return gulp.src(['src/public_html/styles/vendor/**/*.*', '!src/public_html/styles/vendor/**/*.md'])
    .pipe(gulp.dest('build/public_html/styles/vendor'));
  }
);

// Copy style font files to build
gulp.task('style-fonts', function() {
  return gulp.src(['src/public_html/styles/fonts/**/*.*', '!src/public_html/styles/fonts/**/*.md'])
    .pipe(gulp.dest('build/public_html/styles/fonts'));
  }
);

// Copy script vendor files to build
gulp.task('script-vendor', function() {
  return gulp.src(['src/public_html/scripts/vendor/**/*.*', '!src/public_html/scripts/vendor/**/*.md'])
    .pipe(gulp.dest('build/public_html/scripts/vendor'));
  }
);

// Copy htaccess from src to build
gulp.task('htaccess', function () {
  return gulp.src('src/**/.htaccess')
    .pipe(gulp.dest('build'));
  }
);

// Delete all files in the build directory
gulp.task('clean', function() {
  return del(['build/**', '!build']);
});

// Rebuild composer autoload
gulp.task('autoload-rebuild', function (cb) {
  exec('cd src && composer dump-autoload', function (err, stdout, stderr) {
    console.log(stdout);
    console.log(stderr);
    cb(err);
  });
});

// Watch task
gulp.task('watch', function() {
    gulp.watch('src/public_html/styles/**/*.scss', gulp.series('styles'));
    gulp.watch('src/public_html/scripts/**/*.js', gulp.series('scripts'));
    gulp.watch('src/public_html/images/**/*', gulp.series('images'));
    gulp.watch('src/**/*.php', gulp.series('php'));
    gulp.watch('src/**/*.html', gulp.series('html'));
    gulp.watch('src/**/*.xml', gulp.series('xml'));
    gulp.watch('src/**/.htaccess', gulp.series('htaccess'));
    gulp.watch('src/public_html/styles/vendor/**/*.*', gulp.series('style-vendor'));
    gulp.watch('src/public_html/styles/fonts/**/*.*', gulp.series('style-fonts'));
    gulp.watch('src/public_html/scripts/vendor/**/*.*', gulp.series('script-vendor'));
  }
);

// Build task
gulp.task('build', gulp.series([
  'clean',
  'styles',
  'style-vendor',
  'style-fonts',
  'scripts',
  'script-vendor',
  'images',
  'php',
  'html',
  'xml',
  'htaccess',
  'autoload-rebuild'
]));

// Default task
gulp.task('default', gulp.series('build'));
