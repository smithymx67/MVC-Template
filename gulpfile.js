let gulp        = require('gulp');
let sass        = require('gulp-sass');
let cleanCSS    = require('gulp-clean-css');
let sourcemaps  = require('gulp-sourcemaps');
let rename      = require('gulp-rename');
let uglify      = require('gulp-uglify');
let exec        = require('child_process').exec;
let del         = require('del');
let babel       = require("gulp-babel");

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
    .pipe(babel({
        presets: ['@babel/env']
    }))
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

// Copy svg
gulp.task('svg', function() {
    return gulp.src('src/**/*.svg')
      .pipe(gulp.dest('build'));
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
  return gulp.src(['src/public_html/styles/font/**/*.*', '!src/public_html/styles/font/**/*.md'])
    .pipe(gulp.dest('build/public_html/styles/font'));
  }
);

// Copy style font files to build
gulp.task('style-webfonts', function() {
    return gulp.src(['src/public_html/styles/webfonts/**/*.*', '!src/public_html/styles/webfonts/**/*.md'])
      .pipe(gulp.dest('build/public_html/styles/webfonts'));
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
    gulp.watch('src/**/*.svg', gulp.series('svg'));
    gulp.watch('src/**/*.html', gulp.series('html'));
    gulp.watch('src/**/*.xml', gulp.series('xml'));
    gulp.watch('src/**/.htaccess', gulp.series('htaccess'));
    gulp.watch('src/public_html/styles/vendor/**/*.*', gulp.series('style-vendor'));
    gulp.watch('src/public_html/styles/font/**/*.*', gulp.series('style-fonts'));
    gulp.watch('src/public_html/styles/webfonts/**/*.*', gulp.series('style-webfonts'));
    gulp.watch('src/public_html/scripts/vendor/**/*.*', gulp.series('script-vendor'));
  }
);

// Build task
gulp.task('build', gulp.series([
  'clean',
  'styles',
  'style-vendor',
  'style-fonts',
  'style-webfonts',
  'scripts',
  'script-vendor',
  'images',
  'php',
  'html',
  'xml',
  'svg',
  'htaccess',
  'autoload-rebuild'
]));

// Default task
gulp.task('default', gulp.series('build'));
