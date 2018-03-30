/**
 * Dependencies
 * -----------------------------------------------------------------------------
 */

const autoprefixer = require('autoprefixer');
const babel = require('gulp-babel');
const bs = require('browser-sync');
const changed = require('gulp-changed');
const del = require('del');
const eslint = require('gulp-eslint');
const gulp = require('gulp');
const include = require('gulp-include');
const pug = require('gulp-pug');
const includetemplate = require("gulp-include-template");
const minimist = require('minimist');
const nano = require('gulp-cssnano');
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const sassglob = require('gulp-sass-glob');
const sequence = require('run-sequence');
const uglify = require('gulp-uglify');
const plumber = require('gulp-plumber');
const gutil = require('gulp-util');
const phplint = require('gulp-phplint');

/**
 * Set paths
 * -----------------------------------------------------------------------------
 */

const path = {
  build: 'build',
  src: 'src',
};

/**
 * Set build options
 * -----------------------------------------------------------------------------
 */

const options = minimist(process.argv.slice(2), {
  string: ['env'],
  default: {
    env: 'dev',
  },
});

/**
 * Catch stream errors
 * -----------------------------------------------------------------------------
 */

const gulpSrc = gulp.src;

gulp.src = function onError(...args) {
  return gulpSrc
    .apply(gulp, args)
    // Catch errors
    .pipe(plumber(function onError(error) {
      gutil.log(gutil.colors.red(`Error (${error.plugin}):${error.message}`));
      this.emit('end');
    }));
};

/**
 * Default task
 * -----------------------------------------------------------------------------
 */

gulp.task('default', (callback) => sequence(
  ['watch'],
  ['build'],
  callback
));

/**
 * Watch
 * -----------------------------------------------------------------------------
 */

gulp.task('watch', () => {

  // Watch for source changes and execute associated tasks
  gulp.watch(`./${path.src}/data/**/*`, ['data']);
  gulp.watch(`./${path.src}/fonts/**/*`, ['fonts']);
  gulp.watch(`./${path.src}/images/**/*`, ['images']);
  gulp.watch(`./${path.src}/media/**/*`, ['media']);
  gulp.watch(`./${path.src}/misc/**/*`, ['misc']);
  gulp.watch(`./${path.src}/scripts/**/*.js`, ['scripts']);
  gulp.watch(`./${path.src}/styles/**/*.scss`, ['styles']);
  gulp.watch(`./${path.src}/vendors/*.js`, ['vendors']);
  gulp.watch(`./${path.src}/templates/**/*.tpl`, ['views']);
  gulp.watch(`./${path.src}/functions/**/*.php`, ['php']);
});




/**
 * Build static assets
 * -----------------------------------------------------------------------------
 */

gulp.task('build', (callback) => sequence(
  ['clean'],
  ['assets'],
  ['scripts'],
  ['styles'],
  ['vendors'],
  ['views'],
  ['php'],
  callback
));

/**
 * Remove build directory
 * -----------------------------------------------------------------------------
 */

gulp.task('clean', () => del('./build'));

/**
 * Assets
 * -----------------------------------------------------------------------------
 */

gulp.task('assets', (callback) => sequence(
  ['data'],
  ['fonts'],
  ['images'],
  ['media'],
  ['misc'],
  callback
));

/**
 * Copy data files
 * -----------------------------------------------------------------------------
 */

gulp.task('data', () => gulp
  // Select files
  .src(`${path.src}/data/**/*`)
  // Check for changes
  .pipe(changed(`${path.build}/data`))
  // Save files
  .pipe(gulp.dest(`${path.build}/data`))
);

/**
 * Copy font files
 * -----------------------------------------------------------------------------
 */

gulp.task('fonts', () => gulp
  // Select files
  .src(`${path.src}/fonts/**/*`)
  // Check for changes
  .pipe(changed(`${path.build}/fonts`))
  // Save files
  .pipe(gulp.dest(`${path.build}/fonts`))
);

/**
 * Copy image files
 * -----------------------------------------------------------------------------
 */

gulp.task('images', () => gulp
  // Select files
  .src(`${path.src}/images/**/*`)
  // Check for changes
  .pipe(changed(`${path.build}/images`))
  // Save files
  .pipe(gulp.dest(`${path.build}/images`))
);

/**
 * Copy media files
 * -----------------------------------------------------------------------------
 */

gulp.task('media', () => gulp
  // Select files
  .src(`${path.src}/media/**/*`)
  // Check for changes
  .pipe(changed(`${path.build}/media`))
  // Save files
  .pipe(gulp.dest(`${path.build}/media`))
);

/**
 * Copy misc files
 * -----------------------------------------------------------------------------
 */

gulp.task('misc', () => gulp
  // Select files
  .src([
    `${path.src}/misc/${options.env}/**/*`,
    `${path.src}/misc/all/**/*`,
  ], {
    dot: true,
  })
  // Check for changes
  .pipe(changed(path.build))
  // Save files
  .pipe(gulp.dest(path.build))
);

/**
 * Build scripts with transpilers
 * -----------------------------------------------------------------------------
 */

gulp.task('scripts', ['scripts-lint'], () => gulp
  // Select files
  .src(`${path.src}/scripts/*.js`)
  // Concatenate includes
  .pipe(include())
  // Transpile
  .pipe(babel())
  // Save unminified file
  .pipe(gulp.dest(`${path.build}/scripts`))
  // Optimize and minify
  .pipe(uglify())
  // Append suffix
  .pipe(rename({
    suffix: '.min',
  }))
  // Save minified file
  .pipe(gulp.dest(`${path.build}/scripts`))
);

/**
 * Lint scripts
 * -----------------------------------------------------------------------------
 */

gulp.task('scripts-lint', () => gulp
  // Select files
  .src(`${path.src}/scripts/**/*.js`)
  // Check for errors
  // .pipe(eslint())
  // Format errors
  .pipe(eslint.format())
);

/**
 * Build styles with pre-processors and post-processors
 * -----------------------------------------------------------------------------
 */

gulp.task('styles', () => gulp
  // Select files
  .src(`${path.src}/styles/*.scss`)
  // Glob
  .pipe(sassglob())
  // Compile Sass
  .pipe(sass({
    outputStyle: 'expanded',
  }))
  // Add vendor prefixes
  .pipe(postcss([
    autoprefixer,
  ]))
  // Save unminified file
  .pipe(gulp.dest(`${path.build}`))
  // Optimize and minify
  .pipe(nano())
  // Append suffix
  // .pipe(rename({
  //   suffix: '.min',
  // }))
  // Save minified file
  .pipe(gulp.dest(`${path.build}`))
);

/**
 * Bundle vendors
 * -----------------------------------------------------------------------------
 */

gulp.task('vendors', () => gulp
  // Select files
  .src(`${path.src}/vendors/*.js`)
  // Concatenate includes
  .pipe(include({
    includePaths: [
      `${__dirname}/bower_components`,
      `${__dirname}/node_modules`,
    ],
  }))
  // Save files
  .pipe(gulp.dest(`${path.build}/vendors`))
);


/**
 * Build views with pre-processors
 * -----------------------------------------------------------------------------
 */

gulp.task('views', () => gulp
  // Select files
  .src(`${path.src}/templates/**/*.php`)
  // Check which files have changed
  .pipe(changed(path.build, {
    extension: '.php',
  }))
  // Includes
  // .pipe(includetemplate())
  // Save files
  .pipe(gulp.dest(path.build))
);


/**
 * Generate function.php
 * -----------------------------------------------------------------------------
 */

 gulp.task('functionincludes', () => gulp
   // Select files
   .src(`${path.src}/functions/includes/**/*`)
   // Lint (doesn't work?)
   .pipe(phplint())
   // Save files
   .pipe(gulp.dest(`${path.build}/includes`))
 );

gulp.task('functionfile', () => gulp
  // Select files
  .src(`${path.src}/functions/functions.php`)
  // Rename
  .pipe(rename({
    basename: 'functions',
  }))
  // Save files
  .pipe(gulp.dest(path.build))
);

gulp.task('php', (callback) => sequence(
  ['functionincludes'],
  ['functionfile'],
  callback
));
